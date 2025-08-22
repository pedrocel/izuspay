@extends('layouts.mobile-app')

@section('title', $creator->display_name . ' - Perfil')
@section('page-title', $creator->display_name)
@section('page-subtitle', '@' . $creator->username)

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">
    <!-- Header do Perfil -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Cover Image -->
        @if($creator->cover_image_url)
        <div class="h-48 bg-gradient-to-r from-primary-400 to-primary-600">
            <img src="{{ $creator->cover_image_url }}" alt="Capa" class="w-full h-full object-cover">
        </div>
        @else
        <div class="h-48 bg-gradient-to-r from-primary-400 to-primary-600"></div>
        @endif

        <!-- Profile Info -->
        <div class="p-6">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <!-- Profile Picture -->
                    <div class="relative -mt-16">
                        <div class="w-24 h-24 rounded-full bg-white dark:bg-gray-800 p-1">
                            <div class="w-full h-full rounded-full bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 flex items-center justify-center">
                                <span class="text-2xl font-bold text-primary-600">{{ substr($creator->display_name, 0, 1) }}</span>
                            </div>
                        </div>
                        @if($creator->is_verified)
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                            <i data-lucide="check" class="w-4 h-4 text-white"></i>
                        </div>
                        @endif
                    </div>

                    <!-- Basic Info -->
                    <div class="pt-8">
                        <div class="flex items-center space-x-2 mb-1">
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $creator->display_name }}</h1>
                            @if($creator->is_verified)
                            <i data-lucide="check-circle" class="w-6 h-6 text-blue-500"></i>
                            @endif
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 mb-2">{{ '@' . $creator->username }}</p>
                        @if($creator->category)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800 dark:bg-primary-900/20 dark:text-primary-300">
                            {{ $creator->category }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Follow Button -->
                <div class="pt-8">
                    @auth
                    <button id="follow-btn" 
                            onclick="toggleFollow('{{ $creator->username }}')"
                            class="px-6 py-2 rounded-lg font-medium transition-colors {{ $isFollowing ? 'bg-gray-200 text-gray-700 hover:bg-gray-300' : 'bg-primary-600 text-white hover:bg-primary-700' }}">
                        <span id="follow-text">{{ $isFollowing ? 'Seguindo' : 'Seguir' }}</span>
                    </button>
                    @else
                    <a href="{{ route('login') }}" class="px-6 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-colors">
                        Seguir
                    </a>
                    @endauth
                </div>
            </div>

            <!-- Stats -->
            <div class="flex items-center space-x-8 mb-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $creator->posts_count }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">publicações</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900 dark:text-white" id="followers-count">{{ $creator->followers_count }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">seguidores</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $creator->following_count }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">seguindo</div>
                </div>
            </div>

            <!-- Bio -->
            @if($creator->bio)
            <div class="mb-6">
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $creator->bio }}</p>
            </div>
            @endif

            <!-- Additional Info -->
            <div class="space-y-2">
                @if($creator->location)
                <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    <span>{{ $creator->location }}</span>
                </div>
                @endif
                
                @if($creator->website)
                <div class="flex items-center space-x-2 text-sm">
                    <i data-lucide="link" class="w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                    <a href="{{ $creator->website }}" target="_blank" class="text-primary-600 hover:text-primary-700">{{ $creator->website }}</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Posts Grid -->
    @if($creator->news && $creator->news->count() > 0)
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Publicações</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($creator->news as $post)
                <a href="{{ route('cliente.news.show', $post->id) }}" class="group">
                    <article class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                        @if($post->featured_image)
                        <div class="aspect-square bg-gray-200 dark:bg-gray-600">
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        @else
                        <div class="aspect-square bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 flex items-center justify-center">
                            <i data-lucide="image" class="w-12 h-12 text-primary-600"></i>
                        </div>
                        @endif
                        
                        <div class="p-4">
                            <h3 class="font-medium text-gray-900 dark:text-white line-clamp-2 mb-2">{{ $post->title }}</h3>
                            <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                @if($post->views_count)
                                <div class="flex items-center space-x-1">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    <span>{{ $post->views_count }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </article>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="image" class="w-8 h-8 text-gray-400"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nenhuma publicação ainda</h3>
        <p class="text-gray-500 dark:text-gray-400">Este criador ainda não publicou nenhum conteúdo.</p>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .aspect-square {
        aspect-ratio: 1 / 1;
    }
</style>
@endpush

@push('scripts')
<script>
    function toggleFollow(username) {
        const followBtn = document.getElementById('follow-btn');
        const followText = document.getElementById('follow-text');
        const followersCount = document.getElementById('followers-count');
        
        // Desabilitar botão temporariamente
        followBtn.disabled = true;
        followText.textContent = 'Carregando...';
        
        fetch(`{{ url('/cliente/criadores') }}/${username}/toggle-follow`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Atualizar contador de seguidores
            followersCount.textContent = data.followers_count;
            
            // Atualizar botão
            if (data.is_following) {
                followText.textContent = 'Seguindo';
                followBtn.classList.remove('bg-primary-600', 'hover:bg-primary-700', 'text-white');
                followBtn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
            } else {
                followText.textContent = 'Seguir';
                followBtn.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
                followBtn.classList.add('bg-primary-600', 'hover:bg-primary-700', 'text-white');
            }
        })
        .catch(error => {
            console.error('Erro ao seguir/deixar de seguir:', error);
            followText.textContent = 'Erro';
        })
        .finally(() => {
            followBtn.disabled = false;
        });
    }

    // Adicionar meta tag CSRF se não existir
    if (!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '{{ csrf_token() }}';
        document.head.appendChild(meta);
    }
</script>
@endpush

