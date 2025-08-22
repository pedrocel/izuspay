@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="{{ route('cliente.news.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">
            Notícias
        </a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <span class="text-gray-900 dark:text-white">{{ Str::limit($news->title, 50) }}</span>
    </nav>

    <!-- Artigo Principal -->
    <article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Imagem Destacada -->
        @if($news->featured_image)
            <div class="aspect-video w-full overflow-hidden">
                <img src="{{ Storage::url($news->featured_image) }}" 
                     alt="{{ $news->title }}"
                     class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-6 lg:p-8">
            <!-- Header do Artigo -->
            <header class="mb-8">
                <!-- Tags -->
                @if($news->tags && count($news->tags) > 0)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($news->tags as $tag)
                            <a href="{{ route('cliente.news.index', ['tag' => $tag]) }}" 
                               class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">
                                <i data-lucide="tag" class="w-3 h-3 mr-1"></i>
                                {{ $tag }}
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Título -->
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">
                    {{ $news->title }}
                </h1>

                <!-- Resumo -->
                @if($news->summary)
                    <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed mb-6">
                        {{ $news->summary }}
                    </p>
                @endif

                <!-- Meta Informações -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400 pb-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                            <span class="text-xs font-semibold text-white">
                                {{ substr($news->author->name, 0, 1) }}
                            </span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $news->author->name }}</p>
                            <p class="text-xs">Autor</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                        <span>{{ $news->published_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="flex items-center">
                        <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                        <span>{{ $news->reading_time }} min de leitura</span>
                    </div>
                    
                    <div class="flex items-center">
                        <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                        <span>{{ number_format($news->views) }} visualizações</span>
                    </div>

                    @if($news->is_featured)
                        <div class="flex items-center">
                            <i data-lucide="star" class="w-4 h-4 mr-2 text-yellow-500"></i>
                            <span class="text-yellow-600 dark:text-yellow-400 font-medium">Destaque</span>
                        </div>
                    @endif
                </div>
            </header>

            <!-- Conteúdo do Artigo -->
            <div class="prose prose-lg max-w-none dark:prose-invert prose-headings:text-gray-900 dark:prose-headings:text-white prose-p:text-gray-700 dark:prose-p:text-gray-300 prose-a:text-blue-600 dark:prose-a:text-blue-400 prose-strong:text-gray-900 dark:prose-strong:text-white">
                {!! $news->content !!}
            </div>

            <!-- Footer do Artigo -->
            <footer class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                <!-- Compartilhar -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            Gostou desta notícia?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Compartilhe com seus amigos e colegas
                        </p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button onclick="shareOnWhatsApp()" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                            <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i>
                            WhatsApp
                        </button>
                        <button onclick="copyToClipboard()" 
                                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                            <i data-lucide="copy" class="w-4 h-4 mr-2"></i>
                            Copiar Link
                        </button>
                    </div>
                </div>

                <!-- Informações da Associação -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="text-lg font-bold text-white">
                                {{ substr($news->association->nome, 0, 1) }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $news->association->nome }}
                            </h4>
                            @if($news->association->descricao)
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                    {{ Str::limit($news->association->descricao, 150) }}
                                </p>
                            @endif
                            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                @if($news->association->email)
                                    <div class="flex items-center">
                                        <i data-lucide="mail" class="w-4 h-4 mr-1"></i>
                                        {{ $news->association->email }}
                                    </div>
                                @endif
                                @if($news->association->telefone)
                                    <div class="flex items-center">
                                        <i data-lucide="phone" class="w-4 h-4 mr-1"></i>
                                        {{ $news->association->telefone }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </article>

    <!-- Notícias Relacionadas -->
    @if($relatedNews->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                Notícias Relacionadas
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedNews as $related)
                    <article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow">
                        @if($related->featured_image)
                            <div class="aspect-video w-full overflow-hidden">
                                <img src="{{ Storage::url($related->featured_image) }}" 
                                     alt="{{ $related->title }}"
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                <a href="{{ route('cliente.news.show', $related->slug) }}" 
                                   class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    {{ $related->title }}
                                </a>
                            </h3>
                            @if($related->summary)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                                    {{ $related->summary }}
                                </p>
                            @endif
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ $related->published_at->diffForHumans() }}</span>
                                <span>{{ $related->reading_time }} min</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Botão Voltar -->
    <div class="mt-12 text-center">
        <a href="{{ route('cliente.news.index') }}" 
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Voltar às Notícias
        </a>
    </div>
</div>

@push('scripts')
<script>
    // Compartilhar no WhatsApp
    function shareOnWhatsApp() {
        const title = "{{ $news->title }}";
        const url = window.location.href;
        const text = `Confira esta notícia: ${title} - ${url}`;
        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
        window.open(whatsappUrl, '_blank');
    }

    // Copiar link para clipboard
    function copyToClipboard() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(function() {
            // Mostrar notificação de sucesso
            showNotification('Link copiado para a área de transferência!', 'success');
        }).catch(function(err) {
            console.error('Erro ao copiar link: ', err);
            showNotification('Erro ao copiar link', 'error');
        });
    }

    // Função de notificação (assumindo que existe no layout principal)
    function showNotification(message, type = 'success') {
        // Esta função deve estar definida no layout principal
        if (typeof window.showNotification === 'function') {
            window.showNotification(message, type);
        } else {
            alert(message);
        }
    }

    // Incrementar visualizações após 10 segundos
    setTimeout(function() {
        fetch('{{ route("cliente.news.increment-view", $news->slug) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            }
        });
    }, 10000);
</script>
@endpush
@endsection
