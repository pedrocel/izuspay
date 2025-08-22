

@extends('layouts.app')

@section('title', 'Cadastrar Dominio')

@section('content')
    
<header class="glass-effect border-b border-gray-200/50 dark:border-gray-700/50 sticky top-0 z-20">
        <div class="flex justify-between items-center px-4 md:px-8 py-6">
            <div class="flex items-center">
                <button onclick="toggleSidebar()" class="md:hidden mr-4 text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">Cadastrar Domínio</h2>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('domains.index') }}" class="theme-gradient from-primary-600 to-primary-500 text-white px-4 py-2 rounded-xl flex items-center space-x-2 hover:from-primary-700 hover:to-primary-600 transition-all duration-150 shadow-lg hover:shadow-primary-500/20">
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
            <form action="{{ route('domains.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informações Básicas -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i data-lucide="globe" class="w-5 h-5 mr-2"></i>
                                Informações do dominio
                            </h3>
                            
                            <!-- Nome -->
                            <div class="mb-4">
                                <label for="domain" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="globe" class="w-5 h-5"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="domain" 
                                        id="domain" 
                                        class="bg-white/5 dark:bg-gray-800/50 border border-gray-300/20 dark:border-gray-700/50 rounded-xl pl-10 pr-4 py-2 w-full text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                        value="{{ old('domain') }}" 
                                        placeholder="www.seudomionio.com.br"
                                        required
                                    >
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                {{-- Botões --}}
                <div class="flex justify-end mt-8 space-x-4">
                    <a 
                        href="{{ route('domains.index') }}" 
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
                        Salvar Domínio
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection