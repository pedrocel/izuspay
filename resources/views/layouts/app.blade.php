<!DOCTYPE html>
<html lang="pt-BR" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rifas Online')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- BIBLIOTECAS PARA GRÁFICOS E OUTROS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'primary-purple': '#9333ea',      // Roxo primário
                        'secondary-pink': '#ec4899',      // Rosa secundário
                        'accent-orange': '#f97316',       // Laranja de destaque
                        'dark-purple': '#7e22ce',         // Variação escura
                        'light-purple': '#f3e8ff',        // Variação clara
                        'sidebar-bg-dark': '#111827',     // Fundo da sidebar no modo escuro
                        'sidebar-item-hover': '#1f2937',  // Hover do item da sidebar
                        'text-light-gray': '#e5e7eb',     // Texto claro
                        'text-dark-gray': '#9ca3af',      // Texto cinza escuro
                    },
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Efeitos da sidebar com tema roxo/rosa */
        .sidebar-item { transition: all 0.2s ease-in-out; }
        .sidebar-item:hover { 
            background: linear-gradient(135deg, rgba(147, 51, 234, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
            transform: translateX(4px); 
        }
        .sidebar-item.active { 
            background: linear-gradient(135deg, rgba(147, 51, 234, 0.2) 0%, rgba(236, 72, 153, 0.2) 100%);
            border-right: 3px solid #ec4899; 
        }
        .dark .sidebar-item.active { 
            background: linear-gradient(135deg, rgba(147, 51, 234, 0.3) 0%, rgba(236, 72, 153, 0.3) 100%);
        }
        .sidebar-overlay { backdrop-filter: blur(4px); }
        @media (max-width: 1024px) { .sidebar-item:hover { transform: none; } }

        /* Animações de Notificação */
        .notification { animation: slideIn 0.3s ease-out; }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        .notification.removing { animation: slideOut 0.3s ease-in forwards; }
        @keyframes slideOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(100%); opacity: 0; } }

        /* Scrollbar customizada com tema roxo/rosa */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #e5e7eb; }
        .dark ::-webkit-scrollbar-track { background: #1f2937; }
        ::-webkit-scrollbar-thumb { 
            background: linear-gradient(135deg, #9333ea 0%, #ec4899 100%);
            border-radius: 4px; 
        }
        ::-webkit-scrollbar-thumb:hover { background: #7e22ce; }

        /* Gradiente animado de fundo */
        .gradient-bg {
            background: linear-gradient(135deg, #9333ea 0%, #ec4899 25%, #f97316 50%, #ec4899 75%, #9333ea 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-200">
    <div class="flex h-screen relative">
        @if(auth()->check())
            @php
                $perfilAtual = auth()->user()->perfilAtual();
                $perfilNome = $perfilAtual ? $perfilAtual->name : null;
            @endphp
            
            {{-- O ID 'sidebar' é crucial para o JavaScript funcionar --}}
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
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

        <div class="flex-1 flex flex-col overflow-hidden">
            @if(auth()->check())
                @php
                    $perfilAtual = auth()->user()->perfilAtual();
                    $perfilNome = $perfilAtual ? $perfilAtual->name : null;
                @endphp
                
                {{-- Inclui o header correto baseado no perfil --}}
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

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900 p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Container de Notificações -->
    <div aria-live="assertive" class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
        <div id="notification-container" class="w-full flex flex-col items-center space-y-4 sm:items-end"></div>
    </div>

    @stack('scripts')
    
    <script>
        // Inicializa os ícones do Lucide
        lucide.createIcons();

        // --- GERENCIAMENTO DE TEMA (MODO CLARO/ESCURO) ---
        const themeToggleBtn = document.getElementById('theme-toggle');
        const docHtml = document.documentElement;

        // Aplica o tema salvo no carregamento da página
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            docHtml.classList.add('dark');
        } else {
            docHtml.classList.remove('dark');
        }

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                docHtml.classList.toggle('dark');
                const theme = docHtml.classList.contains('dark') ? 'dark' : 'light';
                localStorage.setItem('theme', theme);
            });
        }

        // --- FUNCIONALIDADE DO MENU MOBILE ---
        const openSidebarBtn = document.getElementById('open-sidebar');
        const closeSidebarBtn = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        const openSidebar = () => {
            if (sidebar && sidebarOverlay) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            }
        };

        const closeSidebar = () => {
            if (sidebar && sidebarOverlay) {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }
        };

        if (openSidebarBtn) openSidebarBtn.addEventListener('click', openSidebar);
        if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', closeSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

        // --- SISTEMA DE NOTIFICAÇÃO ---
        window.showNotification = (message, type = 'success') => {
            const container = document.getElementById('notification-container');
            if (!container) return;

            const notification = document.createElement('div');
            let bgColor, icon;

            switch (type) {
                case 'error':
                    bgColor = 'bg-red-500';
                    icon = 'x-circle';
                    break;
                case 'info':
                    bgColor = 'bg-gradient-to-r from-primary-purple to-secondary-pink';
                    icon = 'info';
                    break;
                default: // success
                    bgColor = 'bg-gradient-to-r from-primary-purple to-secondary-pink';
                    icon = 'check-circle';
            }

            notification.className = `max-w-sm w-full ${bgColor} text-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden notification`;
            notification.innerHTML = `
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0"><i data-lucide="${icon}"></i></div>
                        <div class="ml-3 w-0 flex-1 pt-0.5"><p class="text-sm font-medium">${message}</p></div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button type="button" class="inline-flex text-white/70 hover:text-white">
                                <span class="sr-only">Fechar</span>
                                <i data-lucide="x" class="h-5 w-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            const closeBtn = notification.querySelector('button');
            const removeNotif = () => {
                notification.classList.add('removing');
                notification.addEventListener('animationend', () => notification.remove());
            };

            closeBtn.addEventListener('click', removeNotif);
            setTimeout(removeNotif, 5000);

            container.appendChild(notification);
            lucide.createIcons();
        };

        // Exibe notificações do Laravel (se houver)
        @if(session('success'))
            window.showNotification('{{ session('success') }}', 'success');
        @endif
        @if(session('error'))
            window.showNotification('{{ session('error') }}', 'error');
        @endif
        @if(session('info'))
            window.showNotification('{{ session('info') }}', 'info');
        @endif
    </script>
</body>
</html>
