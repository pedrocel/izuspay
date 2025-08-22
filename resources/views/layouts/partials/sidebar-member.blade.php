<!-- Member Sidebar -->
<div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 dark:bg-gray-900 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-between h-16 px-4 bg-gray-900 dark:bg-black">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
            <span class="text-white font-semibold text-lg">Portal do Membro</span>
        </div>
        <button onclick="closeMobileMenu()" class="lg:hidden text-gray-400 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <nav class="mt-8 px-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('member.dashboard') }}" 
           data-route="{{ route('member.dashboard') }}"
           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
            <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
            <span>Dashboard</span>
        </a>
        
        <!-- Meu Perfil -->
        <a href="{{ route('member.profile.index') }}" 
           data-route="{{ route('member.profile.index') }}"
           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
            <i class="fas fa-user w-5 h-5 mr-3"></i>
            <span>Meu Perfil</span>
        </a>
        
        <!-- Notícias -->
        <a href="{{ route('member.news.index') }}" 
           data-route="{{ route('member.news.index') }}"
           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
            <i class="fas fa-newspaper w-5 h-5 mr-3"></i>
            <span>Notícias</span>
        </a>
        
        <!-- Eventos -->
        <a href="{{ route('member.events.index') }}" 
           data-route="{{ route('member.events.index') }}"
           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
            <i class="fas fa-calendar w-5 h-5 mr-3"></i>
            <span>Eventos</span>
        </a>
        
        <!-- Mensalidades -->
        <div x-data="{ open: {{ request()->routeIs('member.payments*') ? 'true' : 'false' }} }">
            <button @click="open = !open" 
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                <div class="flex items-center">
                    <i class="fas fa-credit-card w-5 h-5 mr-3"></i>
                    <span>Mensalidades</span>
                </div>
                <i class="fas fa-chevron-down transform transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-transition class="ml-4 mt-2 space-y-1">
                <a href="{{ route('member.payments.index') }}" 
                   data-route="{{ route('member.payments.index') }}"
                   class="flex items-center px-4 py-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                    <i class="fas fa-list w-4 h-4 mr-3"></i>
                    <span>Histórico</span>
                </a>
                <a href="{{ route('member.payments.pending') }}" 
                   data-route="{{ route('member.payments.pending') }}"
                   class="flex items-center px-4 py-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                    <i class="fas fa-exclamation-triangle w-4 h-4 mr-3"></i>
                    <span>Pendentes</span>
                </a>
            </div>
        </div>
        
        <!-- Documentos -->
        <a href="{{ route('member.documents.index') }}" 
           data-route="{{ route('member.documents.index') }}"
           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
            <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
            <span>Documentos</span>
        </a>
        
        <!-- Suporte -->
        <div x-data="{ open: {{ request()->routeIs('member.support*') ? 'true' : 'false' }} }">
            <button @click="open = !open" 
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                <div class="flex items-center">
                    <i class="fas fa-headset w-5 h-5 mr-3"></i>
                    <span>Suporte</span>
                </div>
                <i class="fas fa-chevron-down transform transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-transition class="ml-4 mt-2 space-y-1">
                <a href="{{ route('member.support.tickets') }}" 
                   data-route="{{ route('member.support.tickets') }}"
                   class="flex items-center px-4 py-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                    <i class="fas fa-ticket-alt w-4 h-4 mr-3"></i>
                    <span>Meus Tickets</span>
                </a>
                <a href="{{ route('member.support.create') }}" 
                   data-route="{{ route('member.support.create') }}"
                   class="flex items-center px-4 py-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                    <i class="fas fa-plus w-4 h-4 mr-3"></i>
                    <span>Novo Ticket</span>
                </a>
                <a href="{{ route('member.support.faq') }}" 
                   data-route="{{ route('member.support.faq') }}"
                   class="flex items-center px-4 py-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200">
                    <i class="fas fa-question-circle w-4 h-4 mr-3"></i>
                    <span>FAQ</span>
                </a>
            </div>
        </div>
    </nav>
</div>

<!-- Mobile Overlay -->
<div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden" onclick="closeMobileMenu()"></div>
