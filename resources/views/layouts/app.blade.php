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

    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 0 0 6px #a3e635, 0 0 12px #a3e635, 0 0 18px #a3e635;
            color: #a3e635;
        }
        50% {
            box-shadow: 0 0 18px #bef264, 0 0 30px #bef264, 0 0 42px #bef264;
            color: #bef264;
        }
    }
    .ia-pulse {
        animation: pulse-glow 2.5s infinite ease-in-out;
    }

    /* Estilo do gradiente de fundo para o modal principal */
    .modal-green-gradient {
        background-color: #0f172a; /* slate-900 */
        background-image: radial-gradient(circle at top right, rgba(16, 185, 129, 0.15), transparent 40%);
    }
    
    /* Estilo do gradiente de fundo para o modal de IA */
    .modal-ia-gradient {
        background-color: #1e293b; /* slate-800 */
        background-image: radial-gradient(circle at top center, rgba(163, 230, 53, 0.1), transparent 50%);
    }
    




    @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes glow {
    0%, 100% { box-shadow: 0 0 5px rgba(59, 130, 246, 0.5); }
    50% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.8), 0 0 30px rgba(59, 130, 246, 0.6); }
}

@keyframes slide-down {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-glow {
    animation: glow 3s ease-in-out infinite;
}

.animate-slide-down {
    animation: slide-down 0.3s ease-out;
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

/* Gradiente animado para bordas */
@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.animate-gradient {
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient-shift 3s ease infinite;
}

/* Scrollbar customizada */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

.dark .custom-scrollbar::-webkit-scrollbar-track {
    background: #374151;
}

.dark .custom-scrollbar::-webkit-scrollbar-thumb {
    background: #6b7280;
}

/* Responsividade melhorada */
@media (max-width: 640px) {
    .grid {
        gap: 1rem;
    }
    
    .text-2xl {
        font-size: 1.5rem;
    }
    
    .w-16.h-16 {
        width: 3rem;
        height: 3rem;
    }
    
    .w-8.h-8 {
        width: 1.75rem;
        height: 1.75rem;
    }
}

/* Hover effects aprimorados */
.card-glow {
    position: relative;
}

.card-glow::before {
    content: '';
    position: absolute;
    inset: -2px;
    padding: 2px;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
    border-radius: inherit;
    mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    mask-composite: xor;
    opacity: 0;
    transition: opacity 0.3s;
}

.card-glow:hover::before {
    opacity: 1;
}







@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    25% { transform: translateY(-5px) rotate(1deg); }
    50% { transform: translateY(-10px) rotate(0deg); }
    75% { transform: translateY(-5px) rotate(-1deg); }
}

@keyframes glow-pulse {
    0%, 100% { 
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
        transform: scale(1);
    }
    50% { 
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.6), 0 0 60px rgba(59, 130, 246, 0.4);
        transform: scale(1.01);
    }
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes heartbeat {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Efeitos de borda premium */
.card-premium {
    position: relative;
}

.card-premium::before {
    content: '';
    position: absolute;
    inset: -1px;
    padding: 1px;
    background: linear-gradient(45deg, 
        transparent, 
        rgba(255,255,255,0.1), 
        transparent, 
        rgba(255,255,255,0.1), 
        transparent
    );
    border-radius: inherit;
    mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    mask-composite: xor;
    opacity: 0;
    transition: opacity 0.3s;
    animation: shimmer 3s infinite;
}

.card-premium:hover::before {
    opacity: 1;
}

/* Efeito de vidro premium */
.glass-effect {
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.125);
}

/* Gradientes animados para ícones */
@keyframes gradient-rotate {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.animate-gradient {
    background: linear-gradient(-45deg, currentColor, rgba(255,255,255,0.8), currentColor);
    background-size: 400% 400%;
    animation: gradient-rotate 3s ease infinite;
}

/* Melhorar responsividade */
@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .rounded-3xl {
        border-radius: 1.5rem;
    }
    
    .p-8 {
        padding: 1.5rem;
    }
    
    .text-3xl {
        font-size: 1.875rem;
    }
    
    .w-16.h-16 {
        width: 3.5rem;
        height: 3.5rem;
    }
    
    .w-8.h-8 {
        width: 1.75rem;
        height: 1.75rem;
    }
}

@media (min-width: 768px) and (max-width: 1024px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Efeitos de hover premium */
.group:hover .animate-float {
    animation: float 3s ease-in-out infinite;
}

.group:hover .animate-heartbeat {
    animation: heartbeat 1.5s ease-in-out infinite;
}

/* Efeito de partículas flutuantes */
@keyframes particle-float {
    0%, 100% { transform: translateY(0px) translateX(0px) rotate(0deg); opacity: 0.4; }
    25% { transform: translateY(-10px) translateX(5px) rotate(90deg); opacity: 0.8; }
    50% { transform: translateY(-5px) translateX(-5px) rotate(180deg); opacity: 1; }
    75% { transform: translateY(-15px) translateX(10px) rotate(270deg); opacity: 0.6; }
}

.animate-particle {
    animation: particle-float 4s ease-in-out infinite;
}

/* Dark mode aprimorado */
@media (prefers-color-scheme: dark) {
    .group:hover .glass-effect {
        background: rgba(255, 255, 255, 0.02);
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .dark .group:hover .absolute.inset-0 {
        background: radial-gradient(circle at center, rgba(255,255,255,0.03) 0%, transparent 70%);
    }
}

/* Animação de loading personalizada */
@keyframes custom-spin {
    0% { transform: rotate(0deg) scale(1); }
    50% { transform: rotate(180deg) scale(1.1); }
    100% { transform: rotate(360deg) scale(1); }
}

.animate-custom-spin {
    animation: custom-spin 2s linear infinite;
}

/* Efeito de brilho nas bordas dos cards */
.card-glow-border {
    position: relative;
    overflow: hidden;
}

.card-glow-border::after {
    content: '';
    position: absolute;
    inset: -2px;
    background: conic-gradient(from 0deg, transparent, rgba(59, 130, 246, 0.4), transparent, rgba(139, 92, 246, 0.4), transparent);
    border-radius: inherit;
    opacity: 0;
    transition: opacity 0.3s;
    z-index: -1;
    animation: custom-spin 4s linear infinite;
}

.card-glow-border:hover::after {
    opacity: 1;
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