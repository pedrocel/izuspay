<!-- Header -->
<header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 px-4 lg:px-6 py-4 transition-colors duration-200">
    <div class="flex items-center justify-between">
        <!-- Botão do Menu Mobile (com o ID CORRETO) -->
        <div class="flex items-center space-x-4">
            <button id="open-sidebar" class="lg:hidden p-2 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                <span class="sr-only">Abrir menu</span>
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
            <!-- Você pode adicionar um título ou breadcrumbs aqui se quiser -->
            <h1 class="hidden md:block text-lg font-semibold text-gray-700 dark:text-gray-200">
                @yield('page-title', 'Dashboard')
            </h1>
        </div>

        <!-- Controles do Lado Direito -->
        <div class="flex items-center space-x-2 lg:space-x-4">
            <!-- Botão de Alternância de Tema -->
            <button id="theme-toggle" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <span class="sr-only">Alternar tema</span>
                <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
                <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
            </button>

            <!-- Adicione outros botões como notificações ou perfil aqui -->
            {{-- Exemplo de botão de perfil --}}
            
        </div>
    </div>
</header>
