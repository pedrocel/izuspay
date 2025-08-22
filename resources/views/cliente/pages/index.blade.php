@extends('layouts.app')

@section('title', 'Páginas')

@section('content')
<!-- Header com efeito de vidro e gradiente sutil -->
<header class="sticky top-0 z-30 backdrop-blur-xl bg-white/70 dark:bg-gray-900/80 border-b border-gray-200/50 dark:border-gray-700/50 shadow-sm">
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center">
                <button onclick="toggleSidebar()" class="md:hidden mr-4 text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-purple-400 dark:to-indigo-400">
                        Gerenciador de Páginas
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Gerencie todas as suas páginas em um só lugar</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3">
                <form id="filter-form" action="{{ route('pages.index') }}" method="GET" class="flex items-center space-x-3">
                    <div class="relative">
                        <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Buscar páginas..." class="w-full md:w-64 pl-10 pr-4 py-2 rounded-full border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent">
                        <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                    </div>
                    
                    <div class="dropdown relative">
                        <button type="button" class="flex items-center space-x-1 text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 px-3 py-2 rounded-lg transition-colors" id="filter-dropdown">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                            <span>Filtrar</span>
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </button>
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-20 py-2">
                            <div class="px-3 py-2 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Status</h3>
                                <div class="flex items-center space-x-2 mt-2">
                                    <button type="button" onclick="setStatusFilter('all')" class="status-filter px-2 py-1 text-xs rounded-full {{ request('status') == 'all' || !request('status') ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} hover:bg-purple-100 dark:hover:bg-purple-900/30 hover:text-purple-700 dark:hover:text-purple-300 transition-colors">Todos</button>
                                    <button type="button" onclick="setStatusFilter('active')" class="status-filter px-2 py-1 text-xs rounded-full {{ request('status') == 'active' ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} hover:bg-green-100 dark:hover:bg-green-900/30 hover:text-green-700 dark:hover:text-green-300 transition-colors">Ativos</button>
                                    <button type="button" onclick="setStatusFilter('inactive')" class="status-filter px-2 py-1 text-xs rounded-full {{ request('status') == 'inactive' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-red-700 dark:hover:text-red-300 transition-colors">Inativos</button>
                                </div>
                                <input type="hidden" id="status" name="status" value="{{ request('status', 'all') }}">
                            </div>
                            <div class="px-3 py-2">
                                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Ordenar por</h3>
                                <div class="space-y-1 mt-2">
                                    <button type="button" onclick="setSortOption('name', 'asc')" class="sort-option w-full text-left px-2 py-1 text-xs rounded {{ (request('sort_by') == 'name' && request('sort_direction') == 'asc') || (!request('sort_by') && !request('sort_direction')) ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Nome (A-Z)</button>
                                    <button type="button" onclick="setSortOption('name', 'desc')" class="sort-option w-full text-left px-2 py-1 text-xs rounded {{ (request('sort_by') == 'name' && request('sort_direction') == 'desc') ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Nome (Z-A)</button>
                                    <button type="button" onclick="setSortOption('visits', 'desc')" class="sort-option w-full text-left px-2 py-1 text-xs rounded {{ (request('sort_by') == 'visits' && request('sort_direction') == 'desc') ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Mais visitadas</button>
                                    <button type="button" onclick="setSortOption('created_at', 'desc')" class="sort-option w-full text-left px-2 py-1 text-xs rounded {{ (request('sort_by') == 'created_at' && request('sort_direction') == 'desc') ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Mais recentes</button>
                                </div>
                                <input type="hidden" id="sort_by" name="sort_by" value="{{ request('sort_by', 'name') }}">
                                <input type="hidden" id="sort_direction" name="sort_direction" value="{{ request('sort_direction', 'asc') }}">
                            </div>
                            <div class="px-3 pt-2 pb-1 border-t border-gray-100 dark:border-gray-700 mt-2">
                                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white text-xs py-2 px-3 rounded transition-colors">
                                    Aplicar Filtros
                                </button>
                            </div>
                            <div class="px-3 pb-2">
                                <a href="{{ route('pages.index') }}" class="block text-center w-full bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs py-2 px-3 rounded transition-colors">
                                    Limpar Filtros
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
                
                <a href="{{ route('pages.create') }}" class="relative group overflow-hidden bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-5 py-2 rounded-full flex items-center space-x-2 transition-all duration-300 shadow-md hover:shadow-lg">
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-purple-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-x-0 group-hover:scale-x-100 origin-left"></span>
                    <i data-lucide="plus" class="w-5 h-5 relative z-10"></i>
                    <span class="relative z-10 hidden md:inline">Criar Página</span>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Estatísticas Rápidas -->
<div class="container mx-auto px-4 py-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow p-4 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-100 dark:bg-purple-900/30 p-3 rounded-full">
                    <i data-lucide="file-text" class="w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Páginas</h3>
                    <div class="flex items-end">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pages->total() ?? count($pages) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow p-4 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/30 p-3 rounded-full">
                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Páginas Ativas</h3>
                    <div class="flex items-end">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pages->where('status', 1)->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow p-4 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-100 dark:bg-red-900/30 p-3 rounded-full">
                    <i data-lucide="x-circle" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Páginas Inativas</h3>
                    <div class="flex items-end">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pages->where('status', 0)->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow p-4 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/30 p-3 rounded-full">
                    <i data-lucide="eye" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Visitas</h3>
                    <div class="flex items-end">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pages->sum('visits') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="container mx-auto px-4 mb-6">
    <div class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 p-4 rounded-lg flex items-center shadow-sm animate-fade-in">
        <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto text-green-700 dark:text-green-400 hover:text-green-900 dark:hover:text-green-200">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
</div>
@endif

<div class="container mx-auto px-4 pb-12">
    <div id="pages-container">
        @if(count($pages) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pages as $page)
                <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.05 }}s">
                    <div class="relative">
                        <!-- Barra de status colorida no topo -->
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r {{ $page->status ? 'from-green-400 to-green-600' : 'from-red-400 to-red-600' }}"></div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-200">
                                        {{ $page->name }}
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 font-mono mt-1">
                                        ID: {{ $page->id }}
                                    </p>
                                </div>
                                <form action="{{ route('cliente.pages.toggleStatus', $page->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                        class="relative px-3 py-1.5 rounded-full text-xs font-medium transition-all duration-200 overflow-hidden group/status">
                                        <span class="relative z-10 {{ $page->status ? 'text-green-700 dark:text-green-400' : 'text-red-700 dark:text-red-400' }}">
                                            {{ $page->status ? 'Ativo' : 'Inativo' }}
                                        </span>
                                        <span class="absolute inset-0 {{ $page->status ? 'bg-green-100 dark:bg-green-900/30' : 'bg-red-100 dark:bg-red-900/30' }} transform group-hover/status:scale-95 transition-transform duration-200"></span>
                                    </button>
                                    <input type="hidden" name="status" value="{{ $page->status ? 0 : 1 }}">
                                </form>
                            </div>
                            
                            <div class="mb-4">
                                <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400 mb-1">
                                    <i data-lucide="link" class="w-4 h-4"></i>
                                    <span>URL da Página original:</span>
                                </div>
                                <a href="{{ $page->url_page }}" target="_blank" class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 hover:underline text-sm truncate block group-hover:underline transition-all">
                                    {{ $page->url_page }}
                                </a>
                            </div>
                            
                            <!-- Gráfico de visitas (simulado com barras) -->
                            <div class="mb-4 h-12 bg-gray-50 dark:bg-gray-700/50 rounded-lg p-2">
                                <div class="flex items-end h-full space-x-1">
                                    @php
                                        // Simulando dados de visitas diárias para o gráfico
                                        $dailyVisits = [];
                                        for ($i = 0; $i < 14; $i++) {
                                            $dailyVisits[] = rand(1, 10);
                                        }
                                    @endphp
                                    
                                    @foreach($dailyVisits as $visits)
                                        @php
                                            $height = ($visits / 10) * 100;
                                        @endphp
                                        <div class="w-full bg-purple-200 dark:bg-purple-900/30 rounded-sm hover:bg-purple-300 dark:hover:bg-purple-800/50 transition-colors" style="height: {{ $height }}%"></div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center space-x-1 text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1.5 rounded-full">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    <span class="text-sm font-medium">{{ $page->visits }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">visitas</span>
                                </div>
                                
                                <div class="flex items-center space-x-1">
                                    <a href="{{ route('cliente.pages.detail', $page->name) }}" class="p-2 text-gray-500 hover:text-purple-600 dark:text-gray-400 dark:hover:text-purple-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors transform hover:scale-110 duration-200" title="Visualizar">
                                        <i data-lucide="eye" class="w-5 h-5"></i>
                                    </a>
                                    <a href="{{ route('pages.detail', $page->name) }}" class="p-2 text-gray-500 hover:text-purple-600 dark:text-gray-400 dark:hover:text-purple-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors transform hover:scale-110 duration-200" title="Editar">
                                        <i data-lucide="edit-2" class="w-5 h-5"></i>
                                    </a>
                                    <form action="{{ route('cliente.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta página?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors transform hover:scale-110 duration-200" title="Excluir">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Paginação estilizada -->
            @if(method_exists($pages, 'links') && $pages->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $pages->links() }}
            </div>
            @endif
            
        @else
            <div class="bg-white dark:bg-gray-800 rounded-xl p-12 text-center shadow-md border border-gray-100 dark:border-gray-700 animate-fade-in">
                <div class="flex flex-col items-center justify-center py-8 max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/30 dark:to-indigo-900/30 rounded-full flex items-center justify-center mb-6 animate-pulse">
                        <i data-lucide="file-text" class="w-12 h-12 text-purple-500 dark:text-purple-400"></i>
                    </div>
                    <h3 class="text-2xl font-medium text-gray-900 dark:text-white mb-3">Nenhuma página encontrada</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-8">
                        @if(request('search') || request('status') || request('sort_by'))
                            Nenhuma página corresponde aos filtros aplicados. <a href="{{ route('pages.index') }}" class="text-purple-600 dark:text-purple-400 hover:underline">Limpar filtros</a>
                        @else
                            Comece criando sua primeira página para começar a gerenciar seu conteúdo e aumentar suas conversões
                        @endif
                    </p>
                    
                    @if(!request('search') && !request('status') && !request('sort_by'))
                    <a href="{{ route('pages.create') }}" class="relative overflow-hidden group bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-8 py-3 rounded-lg flex items-center space-x-3 transition-all duration-300 shadow-md hover:shadow-lg transform hover:translate-y-[-2px]">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-purple-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-x-0 group-hover:scale-x-100 origin-left"></span>
                        <i data-lucide="plus" class="w-5 h-5 relative z-10"></i>
                        <span class="relative z-10">Criar Minha Primeira Página</span>
                    </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    // Inicializar ícones Lucide
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        // Dropdown de filtros
        const filterDropdown = document.getElementById('filter-dropdown');
        const dropdownMenu = document.querySelector('.dropdown-menu');
        
        if (filterDropdown && dropdownMenu) {
            filterDropdown.addEventListener('click', function(e) {
                e.preventDefault();
                dropdownMenu.classList.toggle('hidden');
            });
            
            // Fechar dropdown ao clicar fora
            document.addEventListener('click', function(event) {
                if (!filterDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
        
        // Auto-fechar mensagens de sucesso após 5 segundos
        const successMessage = document.querySelector('.bg-green-100');
        if (successMessage) {
            setTimeout(() => {
                successMessage.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => successMessage.remove(), 500);
            }, 5000);
        }
    });
    
    // Funções para os filtros
    function setStatusFilter(status) {
        document.getElementById('status').value = status;
        
        // Atualizar aparência dos botões
        document.querySelectorAll('.status-filter').forEach(button => {
            button.classList.remove('bg-purple-100', 'dark:bg-purple-900/30', 'text-purple-700', 'dark:text-purple-300');
            button.classList.remove('bg-green-100', 'dark:bg-green-900/30', 'text-green-700', 'dark:text-green-300');
            button.classList.remove('bg-red-100', 'dark:bg-red-900/30', 'text-red-700', 'dark:text-red-300');
            button.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
        });
        
        // Aplicar estilo ao botão selecionado
        if (status === 'all') {
            document.querySelector('.status-filter:nth-child(1)').classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            document.querySelector('.status-filter:nth-child(1)').classList.add('bg-purple-100', 'dark:bg-purple-900/30', 'text-purple-700', 'dark:text-purple-300');
        } else if (status === 'active') {
            document.querySelector('.status-filter:nth-child(2)').classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            document.querySelector('.status-filter:nth-child(2)').classList.add('bg-green-100', 'dark:bg-green-900/30', 'text-green-700', 'dark:text-green-300');
        } else if (status === 'inactive') {
            document.querySelector('.status-filter:nth-child(3)').classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            document.querySelector('.status-filter:nth-child(3)').classList.add('bg-red-100', 'dark:bg-red-900/30', 'text-red-700', 'dark:text-red-300');
        }
    }
    
    function setSortOption(field, direction) {
        document.getElementById('sort_by').value = field;
        document.getElementById('sort_direction').value = direction;
        
        // Atualizar aparência dos botões
        document.querySelectorAll('.sort-option').forEach(button => {
            button.classList.remove('bg-purple-100', 'dark:bg-purple-900/30', 'text-purple-700', 'dark:text-purple-300');
            button.classList.add('hover:bg-gray-100', 'dark:hover:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
        });
        
        // Encontrar e destacar o botão selecionado
        let selectedIndex = 0;
        if (field === 'name' && direction === 'asc') selectedIndex = 0;
        else if (field === 'name' && direction === 'desc') selectedIndex = 1;
        else if (field === 'visits' && direction === 'desc') selectedIndex = 2;
        else if (field === 'created_at' && direction === 'desc') selectedIndex = 3;
        
        document.querySelector(`.sort-option:nth-child(${selectedIndex + 1})`).classList.remove('hover:bg-gray-100', 'dark:hover:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
        document.querySelector(`.sort-option:nth-child(${selectedIndex + 1})`).classList.add('bg-purple-100', 'dark:bg-purple-900/30', 'text-purple-700', 'dark:text-purple-300');
    }
    
    // Pesquisa em tempo real (opcional - descomente para ativar)
    /*
    const searchInput = document.getElementById('search');
    if (searchInput) {
        let typingTimer;
        const doneTypingInterval = 500; // tempo em ms
        
        searchInput.addEventListener('input', function() {
            clearTimeout(typingTimer);
            if (this.value) {
                typingTimer = setTimeout(function() {
                    document.getElementById('filter-form').submit();
                }, doneTypingInterval);
            }
        });
    }
    */
</script>

<style>
    /* Animações */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }
    
    /* Estilização da paginação */
    .pagination {
        @apply inline-flex rounded-md shadow-sm;
    }
    
    .pagination li {
        @apply inline-flex items-center;
    }
    
    .pagination li a, .pagination li span {
        @apply px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700;
    }
    
    .pagination li:first-child a, .pagination li:first-child span {
        @apply rounded-l-md;
    }
    
    .pagination li:last-child a, .pagination li:last-child span {
        @apply rounded-r-md;
    }
    
    .pagination li.active span {
        @apply z-10 bg-purple-50 dark:bg-purple-900/30 border-purple-500 dark:border-purple-600 text-purple-600 dark:text-purple-400;
    }
    
    .pagination li a:hover {
        @apply bg-gray-50 dark:bg-gray-700;
    }
    
    .pagination li.disabled span {
        @apply opacity-50 cursor-not-allowed;
    }
</style>
@endsection