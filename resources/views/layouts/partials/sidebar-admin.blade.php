        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 sidebar-overlay z-40 hidden lg:hidden"></div>

<div id="sidebar" class="fixed lg:relative w-72 bg-gray-900 dark:bg-gray-800 text-white flex flex-col z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out h-full">
            <!-- Logo/Brand -->
            <div class="p-4 lg:p-6 border-b border-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 lg:w-10 h-8 lg:h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <i data-lucide="zap" class="w-4 lg:w-6 h-4 lg:h-6 text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-base lg:text-lg font-semibold">Escritório</h1>
                            <p class="text-xs text-gray-400 hidden lg:block">Admin Panel</p>
                        </div>
                    </div>
                    <!-- Close button for mobile -->
                    <button id="close-sidebar" class="lg:hidden p-2 text-gray-400 hover:text-white">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation Menu -->
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
  <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->is('*dashboard*') ? 'active text-white ' : '' }} flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="layout-dashboard" class="h-5 w-5 {{ request()->is('*dashboard*') ? 'text-white' : '' }} "></i>
    <span>Resumo</span>
  </a>

  <a href="{{ route('admin.produtos.index') }}" class="sidebar-item {{ request()->is('*produtos*') ? 'active text-white ' : '' }} flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="package" class="h-5 w-5 text-gray-400"></i>
    <span>Produtos</span>
  </a>
  
  <a href="{{ route('admin.planos.index') }}" class="sidebar-item {{ request()->is('*planos*') ? 'active text-white ' : '' }} flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="package" class="h-5 w-5 text-gray-400"></i>
    <span>Planos</span>
  </a>

  <a href="{{ route('admin.users.index') }}" class="sidebar-item {{ request()->is('*users*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="wallet" class="h-5 w-5 text-gray-400"></i>
    <span>Contas</span>
  </a>
  
  <a href="#" class="sidebar-item {{ request()->is('*vendas*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-3 rounded-lg text-sm text-gray-300 font-medium hover:bg-gray-800 dark:bg-gray-700">
    <i data-lucide="shopping-cart" class="h-5 w-5 text-gray-400"></i>
    <span>Vendas</span>
  </a>
  
  <a href="#" class="sidebar-item flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="shield-alert" class="h-5 w-5 text-gray-400"></i>
    <span>Chargeback</span>
  </a>
  
  <a href="#" class="sidebar-item flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="credit-card" class="h-5 w-5 text-gray-400"></i>
    <span>Painel Financeiro</span>
  </a>

  <a href="#" class="sidebar-item flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="bar-chart-2" class="h-5 w-5 text-gray-400"></i>
    <span>Relatórios</span>
  </a>

  <a href="#" class="sidebar-item flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="building-2" class="h-5 w-5 text-gray-400"></i>
    <span>Empresa</span>
  </a>

  <a href="#" class="sidebar-item flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="file-text" class="h-5 w-5 text-gray-400"></i>
    <span>Faturas do Whitelabel</span>
  </a>

  <a href="#" class="sidebar-item flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-700">
    <i data-lucide="check-square" class="h-5 w-5 text-gray-400"></i>
    <span>Lista de Aprovação</span>
  </a>
</nav>


            <!-- User Profile -->
            <div class="p-3 lg:p-4 border-t border-gray-800 dark:border-gray-700">
                <button id="user-profile-btn" class="w-full flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-700 transition-colors">
                    <div class="w-8 lg:w-10 h-8 lg:h-10 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-xs lg:text-sm font-semibold text-white">JS</span>
                    </div>
                    <div class="flex-1 min-w-0 text-left">
                        <p class="text-sm font-medium truncate">João Silva</p>
                        <p class="text-xs text-gray-400 truncate">Administrador</p>
                    </div>
                    <i data-lucide="chevron-up" class="w-4 h-4 text-gray-400"></i>
                </button>
            </div>
        </div>