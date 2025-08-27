@extends('layouts.mobile-app')

@section('title', 'Dashboard - Cliente')
@section('page-title', 'Lux Secrets')
@section('page-subtitle', 'Descubra e siga seus criadores favoritos')

@section('content')
<div class="p-6 space-y-6">
    <!-- Stories Section (Criadores Seguidos) -->
    @if(isset($followingCreators) && $followingCreators->count() > 0)
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-display font-semibold text-gray-900 dark:text-white">Stories</h2>
            <a href="{{ route('cliente.creators.following') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Ver todos</a>
        </div>
        
        <div class="flex space-x-4 overflow-x-auto pb-2">
            @foreach($followingCreators as $creator)
            <a href="{{ route('cliente.creators.profile', $creator->username) }}" class="flex-shrink-0 text-center">
                <div class="relative">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-pink-500 via-red-500 to-yellow-500 p-0.5">
                        <div class="w-full h-full rounded-full bg-white dark:bg-gray-800 p-0.5">
                            <div class="w-full h-full rounded-full bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 flex items-center justify-center">
                                <span class="text-sm font-semibold text-primary-600">{{ substr($creator->display_name, 0, 1) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2 truncate w-16">{{ $creator->display_name }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Sugestões de Criadores -->
    @if(isset($suggestedCreators) && $suggestedCreators->count() > 0)
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-display font-semibold text-gray-900 dark:text-white">Sugestões para você</h2>
                <a href="{{ route('cliente.creators.explore') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Ver todos</a>
            </div>
            
            <div class="space-y-4">
                @foreach($suggestedCreators->take(3) as $creator)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 flex items-center justify-center">
                            <span class="text-sm font-semibold text-primary-600">{{ substr($creator->display_name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $creator->display_name }}</p>
                                @if($creator->is_verified)
                                <i data-lucide="check-circle" class="w-4 h-4 text-blue-500"></i>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ '@' . $creator->username }}</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $creator->followers_count }} seguidores</p>
                        </div>
                    </div>
                    <button onclick="followCreator('{{ $creator->username }}')" class="px-4 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-xs font-medium rounded-lg transition-colors">
                        Seguir
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Feed de Notícias -->
    @if(isset($news) && $news->count() > 0)
    <div class="space-y-6">
        @foreach($news as $article)
        <article class="bg-white dark:bg-black rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- Header do Post -->
            <div class="p-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    @if($article->creatorProfile)
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 flex items-center justify-center">
                        <a href="{{ route('public.creator.profile', $article->creatorProfile->username) }}" class="text-sm font-semibold text-primary-600">{{ substr($article->creatorProfile->display_name, 0, 1) }}</a>
                    </div>
                    <div>
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('public.creator.profile', $article->creatorProfile->username) }}" class="text-sm font-medium text-gray-900 dark:text-white">{{ $article->creatorProfile->display_name }}</a>
                            @if($article->creatorProfile->is_verified)
                            <i data-lucide="check-circle" class="w-4 h-4 text-blue-500"></i>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $article->created_at->diffForHumans() }}</p>
                    </div>
                    @else
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                        <i data-lucide="user" class="w-5 h-5 text-gray-500"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $article->author->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $article->created_at->diffForHumans() }}</p>
                    </div>
                    @endif
                </div>
                <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Imagem do Post -->
            @if($article->featured_image)
                <div class="bg-gray-100 dark:bg-gray-700">
                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}">
                </div>
            @endif


            <!-- Ações do Post -->
            <div class="p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-700 dark:text-gray-300 hover:text-red-500 transition-colors">
                            <i data-lucide="heart" class="w-6 h-6"></i>
                        </button>
                        <button class="text-gray-700 dark:text-gray-300 hover:text-blue-500 transition-colors">
                            <i data-lucide="message-circle" class="w-6 h-6"></i>
                        </button>
                        <button class="text-gray-700 dark:text-gray-300 hover:text-green-500 transition-colors">
                            <i data-lucide="send" class="w-6 h-6"></i>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <!-- Indicador de conteúdo privado -->
                        @if($article->is_private)
                        <div class="flex items-center space-x-1 px-2 py-1 bg-yellow-100 dark:bg-yellow-900/20 rounded-full">
                            <i data-lucide="lock" class="w-3 h-3 text-yellow-600 dark:text-yellow-400"></i>
                            <span class="text-xs text-yellow-600 dark:text-yellow-400 font-medium">Premium</span>
                        </div>
                        @endif
                        <button class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 transition-colors">
                            <i data-lucide="bookmark" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>

                <!-- Curtidas -->
                <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">
                    {{ $article->views_count ?? rand(10, 500) }} curtidas
                </p>

                <!-- Conteúdo -->
                <div class="text-sm text-gray-900 dark:text-white">
                    @if($article->creatorProfile)
                    <span class="font-medium">{{ $article->creatorProfile->display_name }}</span>
                    @endif
                    <span class="ml-1">{{ $article->title }}</span>
                </div>

                @if($article->content)
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">
                    {{ Str::limit(strip_tags($article->content), 100) }}
                </p>
                @endif

                <!-- Ver mais -->
                <a href="{{ route('cliente.news.show', $article->id) }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 mt-1 inline-block">
                    Ver mais
                </a>
            </div>
        </article>
        @endforeach
    </div>
    @else
    <!-- Estado vazio -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="users" class="w-8 h-8 text-gray-400"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nenhum conteúdo ainda</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-6">Comece seguindo alguns criadores para ver o conteúdo deles aqui.</p>
        <a href="{{ route('cliente.creators.explore') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
            <i data-lucide="compass" class="w-4 h-4 mr-2"></i>
            Explorar criadores
        </a>
    </div>
    @endif

    <!-- Bottom Navigation for Mobile -->
    
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
    // Função para seguir criador
    function followCreator(username) {
        fetch(`{{ url('/cliente/criadores') }}/${username}/toggle-follow`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.action === 'followed') {
                // Atualizar UI para mostrar que está seguindo
                event.target.textContent = 'Seguindo';
                event.target.classList.remove('bg-primary-600', 'hover:bg-primary-700');
                event.target.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
            }
        })
        .catch(error => {
            console.error('Erro ao seguir criador:', error);
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
