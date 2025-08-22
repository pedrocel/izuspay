@extends('layouts.app')

@section('title', 'Cadastrar Página')

@section('content')
    <header class="glass-effect border-b border-gray-200/50 dark:border-gray-700/50 sticky top-0 z-20">
        <div class="flex justify-between items-center px-4 md:px-8 py-6">
            <div class="flex items-center">
                <button onclick="toggleSidebar()" class="md:hidden mr-4 text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">Cadastrar Página</h2>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('pages.index') }}" class="theme-gradient from-primary-600 to-primary-500 text-white px-4 py-2 rounded-xl flex items-center space-x-2 hover:from-primary-700 hover:to-primary-600 transition-all duration-150 shadow-lg hover:shadow-primary-500/20">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    <span class="hidden md:inline">Voltar</span>
                </a>
            </div>
        </div>
    </header>

    @if(session('success'))
    <div class="glass-effect bg-green-100/10 dark:bg-green-900/20 text-green-800 dark:text-green-300 p-4 rounded-xl m-4 md:m-8 flex items-center">
        <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
        {{ session('success') }}
    </div>
    @endif

    <div class="p-4 md:p-8">
        <div class="glass-effect rounded-2xl p-6 shadow-lg">
            <form action="{{ route('pages.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informações Básicas -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i data-lucide="file-text" class="w-5 h-5 mr-2 text-primary-500"></i>
                                Informações da Página
                            </h3>
                            
                            <!-- Nome -->
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="file" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        class="bg-white/5 dark:bg-gray-800/50 border border-gray-300/20 dark:border-gray-700/50 rounded-xl pl-10 pr-4 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                        value="{{ old('name') }}" 
                                        placeholder="Nome da página"
                                        required
                                        pattern="^[a-zA-Z0-9-]+$"
                                        title="Apenas letras, números e hífens são permitidos."
                                    >
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- URL da Página -->
                            <div class="mb-4">
                                <label for="url_page" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">URL da Página a ser clonada</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="link" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="url" 
                                        name="url_page" 
                                        id="url_page" 
                                        class="bg-white/5 dark:bg-gray-800/50 border border-gray-300/20 dark:border-gray-700/50 rounded-xl pl-10 pr-4 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                        value="{{ old('url_page') }}" 
                                        placeholder="https://exemplo.com"
                                        required
                                    >
                                </div>
                                @error('url_page')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- ID Externo -->
                            <div class="mb-4">
                                <label for="external_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ID Externo</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="hash" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="number" 
                                        name="external_id" 
                                        id="external_id" 
                                        class="bg-white/5 dark:bg-gray-800/50 border border-gray-300/20 dark:border-gray-700/50 rounded-xl pl-10 pr-4 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                        value="{{ old('external_id') }}"
                                        placeholder="ID de referência (opcional)"
                                    >
                                </div>
                                @error('external_id')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Modificações -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i data-lucide="edit-2" class="w-5 h-5 mr-2 text-primary-500"></i>
                            Modificações
                        </h3>
                        
                        <div class="bg-white/5 dark:bg-gray-800/30 rounded-xl p-4 border border-gray-200/20 dark:border-gray-700/30">
                            <div id="modifications-container" class="space-y-3">
                                <div class="modification">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tipo</label>
                                            <select 
                                                name="modifications[0][type]" 
                                                class="bg-white/10 dark:bg-gray-800/70 border border-gray-300/20 dark:border-gray-700/50 rounded-lg px-3 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                            >
                                                <option value="link">Link</option>
                                                <option value="image">Imagem</option>
                                                <option value="script">Script</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Valor Antigo</label>
                                            <input 
                                                type="text" 
                                                name="modifications[0][old_value]" 
                                                placeholder="Valor original" 
                                                class="bg-white/10 dark:bg-gray-800/70 border border-gray-300/20 dark:border-gray-700/50 rounded-lg px-3 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                            >
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Novo Valor</label>
                                            <input 
                                                type="text" 
                                                name="modifications[0][new_value]" 
                                                placeholder="Valor substituto" 
                                                class="bg-white/10 dark:bg-gray-800/70 border border-gray-300/20 dark:border-gray-700/50 rounded-lg px-3 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button 
                                type="button" 
                                id="add-modification" 
                                class="mt-4 bg-white/10 dark:bg-gray-800/70 hover:bg-white/20 dark:hover:bg-gray-700/70 text-gray-700 dark:text-gray-300 py-2 px-4 rounded-lg flex items-center text-sm transition-colors duration-150"
                            >
                                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                Adicionar Modificação
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Hidden Fields --}}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="status" value="1">

                {{-- Botões --}}
                <div class="flex justify-end mt-8 space-x-4">
                    <a 
                        href="{{ route('pages.index') }}" 
                        class="px-5 py-2.5 rounded-xl bg-white/5 dark:bg-gray-800/50 text-gray-700 dark:text-gray-300 hover:bg-white/10 dark:hover:bg-gray-700/50 transition-colors flex items-center"
                    >
                        <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                        Cancelar
                    </a>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 rounded-xl theme-gradient from-primary-600 to-primary-500 text-white shadow-lg hover:shadow-primary-500/20 hover:from-primary-700 hover:to-primary-600 transition-all duration-150 flex items-center"
                    >
                        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                        Salvar Página
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar ícones lucide
            lucide.replace();
            
            // Adicionar modificação
            document.getElementById('add-modification').addEventListener('click', function() {
                const container = document.getElementById('modifications-container');
                const index = container.querySelectorAll('.modification').length;
                
                const newModification = document.createElement('div');
                newModification.classList.add('modification');
                newModification.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 relative">
                        <div class="absolute -right-2 -top-2 z-10">
                            <button type="button" class="remove-modification bg-red-500/80 hover:bg-red-600 text-white rounded-full p-1 shadow-md" title="Remover modificação">
                                <i data-lucide="x" class="w-3 h-3"></i>
                            </button>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tipo</label>
                            <select 
                                name="modifications[${index}][type]" 
                                class="bg-white/10 dark:bg-gray-800/70 border border-gray-300/20 dark:border-gray-700/50 rounded-lg px-3 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            >
                                <option value="link">Link</option>
                                <option value="image">Imagem</option>
                                <option value="script">Script</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Valor Antigo</label>
                            <input 
                                type="text" 
                                name="modifications[${index}][old_value]" 
                                placeholder="Valor original" 
                                class="bg-white/10 dark:bg-gray-800/70 border border-gray-300/20 dark:border-gray-700/50 rounded-lg px-3 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Novo Valor</label>
                            <input 
                                type="text" 
                                name="modifications[${index}][new_value]" 
                                placeholder="Valor substituto" 
                                class="bg-white/10 dark:bg-gray-800/70 border border-gray-300/20 dark:border-gray-700/50 rounded-lg px-3 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            >
                        </div>
                    </div>
                    <div class="border-t border-gray-200/10 dark:border-gray-700/30 my-3"></div>
                `;
                
                container.appendChild(newModification);
                
                // Reinicializar ícones lucide para os novos elementos
                lucide.replace();
                
                // Adicionar evento para remover modificação
                newModification.querySelector('.remove-modification').addEventListener('click', function() {
                    newModification.remove();
                    // Reindexar os campos
                    reindexModifications();
                });
            });
            
            // Função para reindexar as modificações após remoção
            function reindexModifications() {
                const modifications = document.querySelectorAll('.modification');
                modifications.forEach((mod, index) => {
                    const selects = mod.querySelectorAll('select');
                    const inputs = mod.querySelectorAll('input');
                    
                    selects.forEach(select => {
                        const name = select.getAttribute('name');
                        if (name) {
                            select.setAttribute('name', name.replace(/\d+/, index));
                        }
                    });
                    
                    inputs.forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            input.setAttribute('name', name.replace(/\d+/, index));
                        }
                    });
                });
            }
        });
    </script>
    
<script>
    document.getElementById('name').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^a-zA-Z0-9-]/g, ''); // Remove espaços e caracteres especiais
    });
</script>
@endsection