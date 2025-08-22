@extends('layouts.app')

@section('title', 'Detalhes do Post Privado - Adoring Fans') {{-- Título ajustado --}}
@section('page-title', 'Visualizar Post Privado') {{-- Título da página ajustado --}}

@section('content')
<div class="max-w-4xl mx-auto space-y-6"> {{-- Adicionado space-y-6 para espaçamento consistente --}}
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6"> {{-- Sombra mais pronunciada e bordas adaptáveis --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"> {{-- Ajustado para layout flexível em telas pequenas --}}
            <div class="flex items-center space-x-2">
                <a href="{{ route('associacao.news.index') }}" 
                   class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-pink-600 dark:hover:text-pink-400 transition-colors"> {{-- Cor do link ajustada --}}
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Voltar aos Posts Privados
                </a>
            </div>
            <div class="flex items-center space-x-2 mt-4 sm:mt-0"> {{-- Margem superior no mobile --}}
                <a href="{{ route('associacao.news.edit', $news) }}" 
                   class="inline-flex items-center px-4 py-2 bg-pink-600 text-white text-sm font-medium rounded-lg hover:bg-pink-700 transition-colors shadow-md"> {{-- Botão rosa com sombra --}}
                    <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                    Editar
                </a>
                <form action="{{ route('associacao.news.destroy', $news) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="button" {{-- Alterado para type="button" para controlar o modal JS --}}
                            onclick="confirmDelete('{{ $news->id }}', '{{ $news->title }}')"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors shadow-md"> {{-- Botão vermelho com sombra --}}
                        <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                        Excluir
                    </button>
                </form>
            </div>
        </div>

        <!-- Status e Ações Rápidas -->
        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"> {{-- Separador e layout flexível --}}
            <div class="flex flex-wrap items-center gap-3"> {{-- Flex-wrap para tags em telas pequenas --}}
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium shadow-sm
                    {{ $news->status === 'published' ? 'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200' : 
                       ($news->status === 'draft' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                       'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200') }}">
                    <i data-lucide="{{ $news->status === 'published' ? 'eye' : ($news->status === 'draft' ? 'edit' : 'archive') }}" 
                       class="w-3 h-3 mr-1"></i>
                    {{ ucfirst($news->status) }}
                </span>

                @if($news->is_featured)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200 shadow-sm"> {{-- Destaque rosa --}}
                        <i data-lucide="star" class="w-3 h-3 mr-1"></i>
                        Destaque
                    </span>
                @endif

                <span class="text-sm text-gray-500 dark:text-gray-400">
                    <i data-lucide="eye" class="w-4 h-4 inline mr-1 text-pink-500"></i> {{-- Ícone de visualizações rosa --}}
                    {{ $news->views }} visualizações
                </span>
            </div>

            <div class="flex flex-wrap items-center gap-2 mt-4 sm:mt-0"> {{-- Botões de ação rápida --}}
                @if($news->status === 'draft')
                    <form action="{{ route('associacao.news.toggle-publish', $news) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-1.5 bg-pink-600 text-white text-xs font-medium rounded hover:bg-pink-700 transition-colors shadow-sm"> {{-- Botão rosa --}}
                            <i data-lucide="send" class="w-3 h-3 mr-1"></i>
                            Publicar
                        </button>
                    </form>
                @elseif($news->status === 'published')
                    <form action="{{ route('associacao.news.toggle-publish', $news) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-1.5 bg-gray-600 text-white text-xs font-medium rounded hover:bg-gray-700 transition-colors shadow-sm"> {{-- Botão cinza --}}
                            <i data-lucide="eye-off" class="w-3 h-3 mr-1"></i>
                            Despublicar
                        </button>
                    </form>
                @endif

                @if($news->is_featured)
                    <form action="{{ route('associacao.news.toggle-featured', $news) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-1.5 bg-gray-600 text-white text-xs font-medium rounded hover:bg-gray-700 transition-colors shadow-sm"> {{-- Botão cinza --}}
                            <i data-lucide="star-off" class="w-3 h-3 mr-1"></i>
                            Remover Destaque
                        </button>
                    </form>
                @else
                    <form action="{{ route('associacao.news.toggle-featured', $news) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-1.5 bg-pink-600 text-white text-xs font-medium rounded hover:bg-pink-700 transition-colors shadow-sm"> {{-- Botão rosa --}}
                            <i data-lucide="star" class="w-3 h-3 mr-1"></i>
                            Destacar
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Artigo -->
        <div class="lg:col-span-2">
            <article class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden"> {{-- Sombra e bordas --}}
                <!-- Imagem Destacada -->
                @if($news->featured_image)
                    <div class="aspect-video w-full overflow-hidden rounded-t-xl"> {{-- Bordas arredondadas maiores --}}
                        <img src="{{ Storage::url($news->featured_image) }}" 
                             alt="{{ $news->title }}"
                             class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-6">
                    <!-- Título -->
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4"> {{-- Cor do texto adaptável --}}
                        {{ $news->title }}
                    </h1>

                    <!-- Meta Informações -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700"> {{-- Layout flex-wrap e borda adaptável --}}
                        <div class="flex items-center">
                            <i data-lucide="user" class="w-4 h-4 mr-2 text-pink-500"></i> {{-- Ícone rosa --}}
                            {{ $news->author->name }}
                        </div>
                        <div class="flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 mr-2 text-pink-500"></i> {{-- Ícone rosa --}}
                            {{ $news->published_at ? $news->published_at->format('d/m/Y H:i') : $news->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="flex items-center">
                            <i data-lucide="clock" class="w-4 h-4 mr-2 text-pink-500"></i> {{-- Ícone rosa --}}
                            {{ $news->reading_time }} min de leitura
                        </div>
                    </div>

                    <!-- Resumo -->
                    @if($news->summary)
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 mb-6 shadow-sm"> {{-- Fundo adaptável e sombra --}}
                            <p class="text-gray-700 dark:text-gray-300 font-medium">
                                {{ $news->summary }}
                            </p>
                        </div>
                    @endif

                    <!-- Conteúdo -->
                    <div class="prose prose-lg max-w-none 
                                prose-headings:text-gray-900 dark:prose-headings:text-gray-100
                                prose-a:text-pink-600 dark:prose-a:text-pink-400
                                prose-strong:text-gray-900 dark:prose-strong:text-gray-100
                                prose-code:text-pink-600 dark:prose-code:text-pink-400
                                prose-li:text-gray-700 dark:prose-li:text-gray-300
                                prose-p:text-gray-700 dark:prose-p:text-gray-300"> {{-- Cores do Prose adaptadas --}}
                        {!! $news->content !!}
                    </div>

                    <!-- Tags -->
                    @if($news->tags && count($news->tags) > 0)
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">Tags:</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($news->tags as $tag)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200 shadow-sm"> {{-- Tags em rosa --}}
                                        <i data-lucide="tag" class="w-3 h-3 mr-1"></i>
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </article>
        </div>

        <!-- Sidebar (Informações Adicionais e Ações) -->
        <div class="space-y-6">
            <!-- Informações do Post Privado -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    <i data-lucide="info" class="w-5 h-5 inline mr-2 text-pink-500"></i> {{-- Ícone rosa --}}
                    Informações do Post
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Criado em:</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $news->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Atualizado em:</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $news->updated_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    @if($news->published_at)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Publicado em:</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $news->published_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Visualizações:</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ number_format($news->views) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Slug:</span>
                        <span class="text-sm font-mono text-gray-900 dark:text-gray-100">
                            {{ $news->slug }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Preview Público -->
            @if($news->status === 'published')
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        <i data-lucide="external-link" class="w-5 h-5 inline mr-2 text-pink-500"></i> {{-- Ícone rosa --}}
                        Preview Público
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Veja como este post privado aparece para os clientes:
                    </p>
                    <a href="#" 
                       target="_blank"
                       class="inline-flex items-center w-full justify-center px-4 py-2 bg-pink-600 text-white text-sm font-medium rounded-lg hover:bg-pink-700 transition-colors shadow-md"> {{-- Botão rosa --}}
                        <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                        Ver como Cliente
                    </a>
                </div>
            @endif

            <!-- Ações Rápidas -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    <i data-lucide="zap" class="w-5 h-5 inline mr-2 text-pink-500"></i> {{-- Ícone rosa --}}
                    Ações Rápidas
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('associacao.news.edit', $news) }}" 
                       class="flex items-center w-full px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <i data-lucide="edit" class="w-4 h-4 mr-3 text-pink-500"></i> {{-- Ícone rosa --}}
                        Editar Post Privado
                    </a>
                    <a href="{{ route('associacao.news.create') }}" 
                       class="flex items-center w-full px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <i data-lucide="plus" class="w-4 h-4 mr-3 text-pink-500"></i> {{-- Ícone rosa --}}
                        Novo Post Privado
                    </a>
                    <a href="{{ route('associacao.news.index') }}" 
                       class="flex items-center w-full px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <i data-lucide="list" class="w-4 h-4 mr-3 text-pink-500"></i> {{-- Ícone rosa --}}
                        Todos os Posts Privados
                    </a>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    <i data-lucide="bar-chart" class="w-5 h-5 inline mr-2 text-pink-500"></i> {{-- Ícone rosa --}}
                    Estatísticas
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-pink-500 rounded-full mr-2"></div> {{-- Cor de ponto rosa --}}
                            <span class="text-sm text-gray-600 dark:text-gray-400">Palavras</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ str_word_count(strip_tags($news->content)) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-pink-600 rounded-full mr-2"></div> {{-- Cor de ponto rosa mais escuro --}}
                            <span class="text-sm text-gray-600 dark:text-gray-400">Caracteres</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ strlen(strip_tags($news->content)) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-pink-700 rounded-full mr-2"></div> {{-- Cor de ponto rosa mais escuro --}}
                            <span class="text-sm text-gray-600 dark:text-gray-400">Tempo de leitura</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $news->reading_time }} min
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal de Confirmação de Exclusão --}}
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl max-w-md w-full p-6 transform transition-all shadow-lg"> {{-- Adicionado sombra ao modal --}}
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 dark:bg-red-900/20 rounded-full">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
            </div>
            
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 text-center mb-2">Confirmar Exclusão</h3>
            <p class="text-gray-600 dark:text-gray-400 text-center mb-6">
                Tem certeza que deseja excluir o post privado <span id="deleteNewsTitle" class="font-medium"></span>? 
                Esta ação não pode ser desfeita.
            </p>
            
            <div class="flex space-x-4">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Confirmar exclusão com modal
    function confirmDelete(newsId, newsTitle) {
        document.getElementById('deleteNewsTitle').textContent = newsTitle;
        document.getElementById('deleteForm').action = `{{ route('associacao.news.destroy', '') }}/${newsId}`; // Ajuste a rota para o destroy
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
