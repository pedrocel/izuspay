<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300"></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed lg:relative w-72 bg-gray-900 text-gray-200 flex flex-col z-50 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out h-full border-r border-gray-800 shadow-2xl">
    <!-- Progress Section -->
    <div class="px-4 py-4 border-b border-gray-800">
        <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-xl p-4">
            <button id="close-sidebar" class="lg:hidden p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
             <div class="justify-center">
                        <img class="text-white text-xl" src="https://i.ibb.co/0pNpWH61/image-removebg-preview-1.png">
                    </div>
            <div class="flex items-center justify-between mb-2">
                
                <span class="text-xs font-medium text-gray-300">Jornada do Sucesso</span>
                <span class="text-xs font-bold bg-gradient-to-r from-[#621d62] to-[#ff00ff] bg-clip-text text-transparent">60%</span>
            </div>
            <div class="w-full bg-gray-600 rounded-full h-2 mb-2">
                <div class="bg-gradient-to-r from-[#621d62] to-[#ff00ff] h-2 rounded-full transition-all duration-500" style="width: 60%"></div>
            </div>
            <div class="flex items-center justify-between text-xs">
                <span class="text-gray-400">R$ 6.000</span>
                <span class="text-gray-400">R$ 10.000</span>
            </div>
            <div class="text-center mt-1">
                <span class="text-xs font-medium bg-gradient-to-r from-[#621d62] to-[#ff00ff] bg-clip-text text-transparent">Nível: Semente</span>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-transparent">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" onclick="showSection('dashboard')" 
           class="sidebar-item {{ request()->is('*dashboard*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Dashboard</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>

        <!-- Atualizando todas as cores pink para as cores do Lux Secrets -->
        <!-- Triagem -->
        <a href="{{ route('associacao.documentos.pending') }}" onclick="showSection('dashboard')" 
           class="sidebar-item {{ request()->is('*documentos*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="filter" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Triagem</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>
        
        <!-- Users -->
        <a href="{{ route('associacao.users.index') }}" onclick="showSection('users')"
           class="sidebar-item {{ request()->is('*usuarios*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="users" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Usuários</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>

        <!-- Messages -->
        <a href="{{ route('associacao.messages.index') }}" onclick="showSection('messages')"
        class="sidebar-item {{ request()->is('*messages*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="message-circle" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Mensagens</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>

        <!-- News -->
        <a href="{{ route('associacao.news.index') }}" 
           class="sidebar-item {{ request()->is('*noticias*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="newspaper" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Conteúdos</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>

        <!-- Products -->
        <a href="{{ route('associacao.products.index') }}" 
           class="sidebar-item {{ request()->is('*products*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="package" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Produtos</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>

        <!-- Plans -->
        <a href="{{ route('associacao.plans.index') }}" 
           class="sidebar-item {{ request()->is('*plans*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="credit-card" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Planos</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>

        <!-- Banners -->
        <a href="{{ route('associacao.banners.index') }}" 
           class="sidebar-item {{ request()->is('*banners*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="image" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Banners</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>
        
         <!-- Sales -->
        <a href="{{ route('associacao.vendas.index') }}" class="sidebar-item {{ request()->is('*vendas*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="shopping-cart" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Vendas</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>

        <!-- Financial -->
        <a href="{{ route('associacao.financeiro.index') }}" class="sidebar-item {{ request()->is('*financeiro*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="dollar-sign" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Financeiro</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>
        
        <!-- Reports -->
        <a href="{{ route('associacao.relatorios.index') }}" class="sidebar-item {{ request()->is('*relatorios*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="bar-chart-3" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Relatórios</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>
        
        <!-- Settings -->
        <a href="{{ route('associacao.configuracoes.edit') }}" class="sidebar-item {{ request()->is('*configuracoes*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-gray-800 relative overflow-hidden">
            <div class="flex items-center space-x-3 relative z-10">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 group-hover:bg-[#621d62]/20 transition-colors duration-200">
                    <i data-lucide="settings" class="w-4 h-4 flex-shrink-0"></i>
                </div>
                <span class="font-medium">Configurações</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/20 to-[#ff00ff]/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </a>
    </nav>

    <!-- User Profile -->
    <div class="p-4 border-t border-gray-800 bg-gray-900">
        <button id="user-profile-btn" class="w-full flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-800 transition-all duration-200 group relative overflow-hidden">
            <div class="w-10 h-10 bg-gradient-to-br from-[#621d62] to-[#ff00ff] rounded-full flex items-center justify-center flex-shrink-0 shadow-lg ring-2 ring-[#621d62]/30">
                <span class="text-sm font-bold text-white">{{ substr(auth()->user()->name, 0, 2) }}</span>
            </div>
            <div class="flex-1 min-w-0 text-left relative z-10">
                <p class="text-sm font-semibold text-gray-200 truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 truncate font-medium">
                    @if(auth()->user()->tipo == 'adm')
                        Administrador
                    @elseif(auth()->user()->tipo == 'Associacao')
                        Associação
                    @else
                        Membro
                    @endif
                </p>
            </div>
            <div class="relative z-10">
                <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400 group-hover:text-[#ff00ff] transition-all duration-200 group-hover:translate-x-1"></i>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#621d62]/10 to-[#ff00ff]/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
        </button>
    </div>
</div>

<style>
    /* Custom scrollbar */
    .scrollbar-thin {
        scrollbar-width: thin;
    }
    
    .scrollbar-thumb-gray-700::-webkit-scrollbar-thumb {
        background-color: #374151; /* gray-700 */
        border-radius: 0.5rem;
    }
    
    .scrollbar-track-transparent::-webkit-scrollbar-track {
        background-color: transparent;
    }
    
    ::-webkit-scrollbar {
        width: 6px;
    }
    
    /* Atualizando cores ativas para usar as cores do Lux Secrets */
    /* Active state styles - using Lux Secrets colors */
    .sidebar-item.active {
        background: linear-gradient(135deg, rgba(98, 29, 98, 0.2), rgba(255, 0, 255, 0.3));
        border-left: 3px solid #621d62;
        box-shadow: 0 4px 12px rgba(98, 29, 98, 0.15);
    }
    
    .sidebar-item.active .w-8 {
        background: linear-gradient(135deg, rgba(98, 29, 98, 0.3), rgba(255, 0, 255, 0.4));
        color: #ff00ff;
    }
    
    .sidebar-item.active span {
        color: #ff00ff;
        font-weight: 600;
    }
    
    /* Micro animations */
    .sidebar-item:hover {
        transform: translateX(2px);
    }
    
    @media (max-width: 1024px) {
        .sidebar-item:hover {
            transform: none;
        }
    }
</style>
