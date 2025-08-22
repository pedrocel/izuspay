<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\News;
use App\Models\CreatorProfile;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Buscar criadores que o usuário segue
        $followingCreators = CreatorProfile::whereHas('followers', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->active()
        ->limit(10)
        ->get();

        // Buscar notícias dos criadores seguidos ou todas se não segue ninguém
        if ($followingCreators->count() > 0) {
            $news = News::with(['author', 'creatorProfile'])
                       ->whereHas('creatorProfile.followers', function($query) use ($user) {
                           $query->where('user_id', $user->id);
                       })
                       ->where('status', 'published')
                       ->latest()
                       ->take(6)
                       ->get();
        } else {
            // Se não segue ninguém, mostrar notícias populares ou recentes
            $news = News::with(['author', 'creatorProfile'])
                       ->where('status', 'published')
                       ->latest()
                       ->take(6)
                       ->get();
        }

        // Buscar criadores sugeridos para seguir
        $suggestedCreators = CreatorProfile::whereDoesntHave('followers', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->active()
        ->orderBy('followers_count', 'desc')
        ->limit(8)
        ->get();

        return view('cliente.dashboard-mobile', compact('news', 'followingCreators', 'suggestedCreators'));
    }

    public function profile()
{
    $user = auth()->user();

    $creator = CreatorProfile::withCount(['posts', 'followers', 'following'])
        ->where('username', $username)
        ->firstOrFail();

    // Verifica se o usuário logado segue esse criador
    $isFollowing = $creator->followers()->where('user_id', $user->id)->exists();

    // Carregar publicações do criador
    $creator->load(['news' => function($q) {
        $q->where('status', 'published')->latest();
    }]);

    return view('cliente.profile.mobile', compact('creator', 'isFollowing'));
}


    /**
     * Exibe todas as notícias
     */
    public function all(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');

        $query = News::with(['author', 'creatorProfile'])
                    ->where('status', 'published');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        $news = $query->latest()->paginate(12);

        // Buscar categorias disponíveis
        $categories = News::where('status', 'published')
                         ->whereNotNull('category')
                         ->distinct()
                         ->pluck('category');

        return view('cliente.news.index', compact('news', 'categories', 'search', 'category'));
    }

    /**
     * Exibe uma notícia específica
     */
    public function show($id)
    {
        $news = News::with(['author', 'creatorProfile'])
                   ->where('status', 'published')
                   ->findOrFail($id);

        // Incrementar visualizaçõesprofile
        $news->increment('views_count');

        // Buscar notícias relacionadas
        $relatedNews = News::with(['author', 'creatorProfile'])
                          ->where('status', 'published')
                          ->where('id', '!=', $news->id)
                          ->where(function($query) use ($news) {
                              if ($news->category) {
                                  $query->where('category', $news->category);
                              }
                              if ($news->creatorProfile) {
                                  $query->orWhere('creator_profile_id', $news->creator_profile_id);
                              }
                          })
                          ->latest()
                          ->limit(4)
                          ->get();

        return view('cliente.news.show', compact('news', 'relatedNews'));
    }
}

