@extends('layouts.app')

@section('title', 'Posts Privados - Adoring Fans') {{-- Título ajustado --}}
@section('page-title', 'Gerenciar Posts Privados') {{-- Título da página ajustado --}}

@section('content')
<div class="space-y-6">
    {{-- Seção de Boas-Vindas/Cabeçalho do Módulo --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-lg"> {{-- Fundo adaptável e borda sutil --}}
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    {{-- Ícone de Posts Privados com fundo rosa --}}
                    <div class="w-10 h-10 bg-pink-500 rounded-lg flex items-center justify-center shadow-md">
                        <i data-lucide="lock" class="w-6 h-6 text-white"></i> {{-- Ícone mudado para 'lock' para posts privados --}}
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Posts Privados</h2> {{-- Título mudado --}}
                </div>
                <p class="text-gray-600 dark:text-gray-400">Crie e gerencie os posts privados da sua associação.</p> {{-- Descrição mudada --}}
            </div>
            {{-- Botão "Novo Post Privado" com estilo rosa e efeito de transição --}}
            <a href="{{ route('associacao.news.create') }}" 
               class="inline-flex items-center space-x-2 bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Novo Post Privado</span> {{-- Texto do botão mudado --}}
            </a>
        </div>
    </div>

    {{-- Cards de Estatísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Card Total de Posts Privados --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300"> {{-- Fundo adaptável, borda e transição --}}
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total</p> {{-- Texto ajustado --}}
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalNews }}</p> {{-- Texto adaptável --}}
                </div>
                {{-- Ícone com fundo adaptável e cor rosa --}}
                <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/20 rounded-lg flex items-center justify-center shadow-sm">
                    <i data-lucide="files" class="w-6 h-6 text-pink-500"></i> {{-- Ícone mudado --}}
                </div>
            </div>
        </div>

        {{-- Card Posts Publicados --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Publicados</p>
                    <p class="text-2xl font-bold text-pink-500">{{ $publishedNews }}</p> {{-- Cor do texto para rosa --}}
                </div>
                {{-- Ícone com fundo adaptável e cor rosa --}}
                <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/20 rounded-lg flex items-center justify-center shadow-sm">
                    <i data-lucide="eye" class="w-6 h-6 text-pink-500"></i> {{-- Cor do ícone para rosa --}}
                </div>
            </div>
        </div>

        {{-- Card Rascunhos --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Rascunhos</p>
                    <p class="text-2xl font-bold text-pink-500">{{ $draftNews }}</p> {{-- Cor do texto para rosa --}}
                </div>
                {{-- Ícone com fundo adaptável e cor rosa --}}
                <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/20 rounded-lg flex items-center justify-center shadow-sm">
                    <i data-lucide="edit" class="w-6 h-6 text-pink-500"></i> {{-- Cor do ícone para rosa --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Barra de Busca e Filtros --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
        <form method="GET" class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Buscar posts privados..." {{-- Placeholder mudado --}}
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"> {{-- Cor do foco para rosa --}}
                </div>
            </div>
            <div class="flex gap-2">
                <select name="status" 
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:text-white"> {{-- Cor do foco para rosa --}}
                    <option value="">Todos os Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publicados</option> {{-- Texto ajustado --}}
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Rascunhos</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Arquivados</option>
                </select>
                <button type="submit" 
                        class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-lg transition-colors"> {{-- Botão para rosa --}}
                    <i data-lucide="search" class="w-4 h-4"></i>
                </button>
                <a href="{{ route('associacao.news.index') }}" 
                   class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </a>
            </div>
        </form>
    </div>

    {{-- Tabela de Posts Privados --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        @if($news->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Post Privado
                            </th> {{-- Cabeçalho mudado --}}
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Autor
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Data
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($news as $article)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($article->featured_image_url)
                                        <img src="{{ $article->featured_image_url }}" 
                                             alt="{{ $article->title }}"
                                             class="w-12 h-12 rounded-lg object-cover mr-4 shadow-sm"> {{-- Adicionado sombra --}}
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center mr-4 shadow-sm"> {{-- Adicionado sombra --}}
                                            <i data-lucide="image" class="w-6 h-6 text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $article->title }}
                                            </h3>
                                            @if($article->is_featured)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200"> {{-- Cor do destaque para rosa --}}
                                                    <i data-lucide="star" class="w-3 h-3 mr-1"></i>
                                                    Destaque
                                                </span>
                                            @endif
                                            {!! $article->getStatusBadge() !!}
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            {{ Str::limit($article->excerpt, 60) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex items-center space-x-2">
                                    <img class="w-8 h-8 rounded-full shadow-sm" src="{{ $article->author->avatar_url }}" alt="{{ $article->author->name }}"> {{-- Adicionado sombra --}}
                                    <span>{{ $article->author->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $article->formatted_date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('associacao.news.show', $article) }}" 
                                       class="text-pink-500 hover:text-pink-700" {{-- Cor para rosa --}}
                                       title="Visualizar">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                    <a href="{{ route('associacao.news.edit', $article) }}" 
                                       class="text-gray-500 hover:text-pink-500 dark:hover:text-pink-400" {{-- Ajuste de cor para edit --}}
                                       title="Editar">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('associacao.news.toggle-publish', $article) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="text-gray-500 hover:text-pink-500 dark:hover:text-pink-400" {{-- Ajuste de cor para publish --}}
                                                title="{{ $article->isPublished() ? 'Despublicar' : 'Publicar' }}">
                                            <i data-lucide="{{ $article->isPublished() ? 'eye-off' : 'eye' }}" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('associacao.news.toggle-featured', $article) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="text-gray-500 hover:text-pink-500 dark:hover:text-pink-400" {{-- Ajuste de cor para featured --}}
                                                title="{{ $article->is_featured ? 'Remover destaque' : 'Destacar' }}">
                                            <i data-lucide="{{ $article->is_featured ? 'star-off' : 'star' }}" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                    <button onclick="confirmDelete('{{ $article->id }}', '{{ $article->title }}')"
                                            class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" {{-- Cor para exclusão --}}
                                            title="Excluir">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $news->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i data-lucide="file-text" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i> {{-- Ícone ajustado --}}
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Nenhum post privado encontrado</h3> {{-- Texto mudado --}}
                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    Comece criando seu primeiro post privado para compartilhar com os membros.
                </p> {{-- Texto mudado --}}
                <a href="{{ route('associacao.news.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-medium rounded-lg transition-colors shadow-md"> {{-- Botão para rosa --}}
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    Criar Primeiro Post Privado
                </a> {{-- Texto do botão mudado --}}
            </div>
        @endif
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
                Tem certeza que deseja excluir o post privado <span id="deleteNewsTitle" class="font-medium"></span>? {{-- Texto mudado --}}
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
    function confirmDelete(newsId, newsTitle) {
        document.getElementById('deleteNewsTitle').textContent = newsTitle;
        document.getElementById('deleteForm').action = `{{ route('associacao.news.index') }}/${newsId}`;
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
