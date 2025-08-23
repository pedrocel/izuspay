<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'username',
        'display_name',
        'bio',
        'profile_image',
        'cover_image',
        'is_verified',
        'followers_count',
        'following_count',
        'posts_count',
        'category',
        'website',
        'location',
        'is_active'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'followers_count' => 'integer',
        'following_count' => 'integer',
        'posts_count' => 'integer'
    ];

    /**
     * Relacionamento com o usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com as notícias/posts do criador
     */
    public function news()
    {
        return $this->hasMany(News::class, 'creator_profile_id');
    }

    public function association()
    {
        return $this->hasOneThrough(Association::class, User::class, 'id', 'id', 'user_id', 'association_id');
    }
    
    /**
     * Relacionamento com os seguidores
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'creator_followers', 'creator_profile_id', 'user_id')
                    ->using(CreatorFollower::class) // usa a model pivot customizada
                    ->withTimestamps();
}


    /**
     * Relacionamento com quem o criador segue
     */
    public function following()
    {
        return $this->belongsToMany(CreatorProfile::class, 'creator_follows', 'follower_id', 'following_id')
                    ->withTimestamps();
    }

    /**
     * Verifica se um usuário segue este criador
     */
    public function isFollowedBy($userId)
    {
        return $this->followers()->where('user_id', $userId)->exists();
    }

    /**
     * Verifica se um usuário tem assinatura ativa deste criador
     */
    public function hasActiveSubscriber($userId)
    {
        return \App\Models\Subscription::query()
            ->whereHas('sale.plan.association.creatorProfile', function($query) {
                $query->where('id', $this->id);
            })
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->where('renews_at', '>', now())
            ->exists();
    }

    /**
     * Relacionamento com assinaturas ativas através das vendas da associação
     */
    public function activeSubscriptions()
    {
        return \App\Models\Subscription::query()
            ->whereHas('sale.plan.association.creatorProfile', function($query) {
                $query->where('id', $this->id);
            })
            ->where('status', 'active')
            ->where('renews_at', '>', now());
    }

    /**
     * Relacionamento com todas as vendas do criador através da associação
     */
    public function sales()
    {
        return \App\Models\Sale::query()
            ->whereHas('plan.association.creatorProfile', function($query) {
                $query->where('id', $this->id);
            })
            ->orWhereHas('product.association.creatorProfile', function($query) {
                $query->where('id', $this->id);
            });
    }

    /**
     * Verifica se usuário pode ver conteúdo privado (seguidor OU assinante ativo)
     */
    public function canUserViewPrivateContent($userId)
    {
        return $this->isFollowedBy($userId) || $this->hasActiveSubscriber($userId);
    }

    /**
     * Verifica se usuário pode ver conteúdo premium (apenas assinantes ativos)
     */
    public function canUserViewPremiumContent($userId)
    {
        return $this->hasActiveSubscriber($userId);
    }

    /**
     * Retorna todos os assinantes ativos do criador
     */
    public function getActiveSubscribersAttribute()
    {
        return $this->activeSubscriptions()
                    ->with('user')
                    ->get()
                    ->pluck('user')
                    ->unique('id');
    }

    /**
     * Accessor para URL da imagem de perfil
     */
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }
        
        // Retorna uma imagem padrão baseada nas iniciais
        return "https://ui-avatars.com/api/?name=" . urlencode($this->display_name) . "&background=22c55e&color=fff&size=200";
    }

    /**
     * Accessor para URL da imagem de capa
     */
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }
        
        return null;
    }

    /**
     * Scope para buscar criadores ativos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para buscar por nome ou username
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('display_name', 'LIKE', "%{$term}%")
              ->orWhere('username', 'LIKE', "%{$term}%")
              ->orWhere('bio', 'LIKE', "%{$term}%");
        });
    }
}
