<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - Sistema de Associações')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
     {{-- BIBLIOTECAS PARA O DASHBOARD DINÂMICO --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    {{-- Carregue o Alpine.js aqui, com 'defer' para otimizar o carregamento sem bloquear a renderização --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-item {
            transition: all 0.2s ease-in-out;
        }
        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }
        .sidebar-item.active {
            background-color: rgba(34, 197, 94, 0.2);
            border-right: 3px solid #ff0ca6;
        }
        .dark .sidebar-item.active {
            background-color: rgba(34, 197, 94, 0.3);
        }
        .sidebar-overlay {
            backdrop-filter: blur(4px);
        }
        @media (max-width: 768px) {
            .sidebar-item:hover {
                transform: none;
            }
        }
        .notification {
            animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .notification.removing {
            animation: slideOut 0.3s ease-in forwards;
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .form-step {
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.form-step.active {
    display: block;
    opacity: 1;
}

.animate-fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Scrollbar customizada com cores roxas */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgb(243 244 246);
}

.dark ::-webkit-scrollbar-track {
    background: rgb(31 41 55);
}

::-webkit-scrollbar-thumb {
    background: rgb(147 51 234);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgb(126 34 206);
}
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 dark:bg-gray-900 overflow-hidden transition-colors duration-200">
    <div class="flex h-screen relative">
        @if(auth()->check())
            @php
                $perfilAtual = auth()->user()->perfilAtual();
                $perfilNome = $perfilAtual ? $perfilAtual->name : null;
            @endphp
            
            @if($perfilNome === 'Administrador')
                @include('layouts.partials.sidebar-admin')
            @elseif($perfilNome === 'Cliente')
                @include('layouts.partials.sidebar-client')
            @elseif($perfilNome === 'Associacao')
                @include('layouts.partials.sidebar-associacao')
            @elseif($perfilNome === 'Membro')
                @include('layouts.partials.sidebar-member')
            @elseif($perfilNome === 'Moderador')
                @include('layouts.partials.sidebar-moderador')
            @endif
        @endif

        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 sidebar-overlay z-40 hidden lg:hidden"></div>

        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            @if(auth()->check())
                @php
                    $perfilAtual = auth()->user()->perfilAtual();
                    $perfilNome = $perfilAtual ? $perfilAtual->name : null;
                @endphp
                
                @if($perfilNome === 'Administrador')
                    @include('layouts.partials.header-admin')
                @elseif($perfilNome === 'Cliente')
                    @include('layouts.partials.header-client')
                @elseif($perfilNome === 'Associacao')
                    @include('layouts.partials.header-associacao')
                @elseif($perfilNome === 'Membro')
                    @include('layouts.partials.header-member')
                @elseif($perfilNome === 'Moderador')
                    @include('layouts.partials.header-moderador')
                @else
                    @include('layouts.partials.header-default')
                @endif
            @endif

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- User Profile Modal -->
    <div id="user-profile-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl max-w-md w-full p-6 transform transition-all">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Perfil do Usuário</h3>
                    <button id="close-user-profile-modal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-semibold text-white">{{ auth()->user()->iniciais ?? 'U' }}</span>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name ?? 'Usuário' }}</h4>
                    <p class="text-gray-500 dark:text-gray-400">{{ auth()->user()->perfil_atual_nome ?? 'Sem perfil' }}</p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                        <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Informações Pessoais</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email ?? 'email@exemplo.com' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                        <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Alterar Senha</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Última alteração há 30 dias</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                        <i data-lucide="bell" class="w-5 h-5 text-gray-400"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Notificações</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Gerenciar preferências</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                        <i data-lucide="shield" class="w-5 h-5 text-gray-400"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Privacidade</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Configurações de segurança</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 p-3 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                            <span class="font-medium">Sair da Conta</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Container -->
    <div id="notifications-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    @stack('scripts')
    
    <script>
        lucide.createIcons();

        // Theme Management
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        // Check for saved theme preference or default to 'light'
        const currentTheme = localStorage.getItem('theme') || 'light';
        html.classList.toggle('dark', currentTheme === 'dark');

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const isDark = html.classList.contains('dark');
                html.classList.toggle('dark', !isDark);
                localStorage.setItem('theme', !isDark ? 'dark' : 'light');
            });
        }

        // Notification System
        function showNotification(message, type = 'success') {
            const container = document.getElementById('notifications-container');
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
            
            notification.className = `notification ${bgColor} text-white px-6 py-4 rounded-lg shadow-lg max-w-sm`;
            notification.innerHTML = `\n                <div class="flex items-center space-x-3">\n                    <i data-lucide="${type === 'success' ? 'check-circle' : type === 'error' ? 'x-circle' : 'info'}" class="w-5 h-5"></i>\n                    <span class="font-medium">${message}</span>\n                    <button onclick="removeNotification(this)" class="ml-auto">\n                        <i data-lucide="x" class="w-4 h-4"></i>\n                    </button>\n                </div>\n            `;
            
            container.appendChild(notification);
            lucide.createIcons();

            // Auto remove after 5 seconds
            setTimeout(() => {
                removeNotification(notification.querySelector('button'));
            }, 5000);
        }

        function removeNotification(button) {
            const notification = button.closest('.notification');
            notification.classList.add('removing');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const closeSidebar = document.getElementById('close-sidebar');

        function openSidebar() {
            if (sidebar) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
        }

        function closeSidebarFunc() {
            if (sidebar) {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', openSidebar);
        }
        
        if (closeSidebar) {
            closeSidebar.addEventListener('click', closeSidebarFunc);
        }
        
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebarFunc);
        }

        // Close sidebar when clicking on a menu item on mobile
        const sidebarItems = document.querySelectorAll('.sidebar-item');
        sidebarItems.forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeSidebarFunc();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeSidebarFunc();
            }
        });

        // User profile modal functionality
        const userProfileBtn = document.getElementById('user-profile-btn');
        const userProfileModal = document.getElementById('user-profile-modal');
        const closeUserProfileModal = document.getElementById('close-user-profile-modal');

        function openUserProfileModal() {
            userProfileModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeUserProfileModalFunc() {
            userProfileModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        if (userProfileBtn) {
            userProfileBtn.addEventListener('click', openUserProfileModal);
        }
        
        if (closeUserProfileModal) {
            closeUserProfileModal.addEventListener('click', closeUserProfileModalFunc);
        }

        // Close modal when clicking outside
        if (userProfileModal) {
            userProfileModal.addEventListener('click', (e) => {
                if (e.target === userProfileModal) {
                    closeUserProfileModalFunc();
                }
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (userProfileModal && !userProfileModal.classList.contains('hidden')) {
                    closeUserProfileModalFunc();
                }
            }
        });

        // Show Laravel flash messages as notifications
        @if(session('success'))
            showNotification('{{ session('success') }}' , 'success');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}' , 'error');
        @endif

        @if(session('info'))
            showNotification('{{ session('info') }}' , 'info');
        @endif
    </script>
</body>
</html>