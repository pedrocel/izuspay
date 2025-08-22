<!DOCTYPE html>
<html lang="pt-BR" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CopyWave Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f7ff',
                            100: '#e0efff',
                            200: '#bae0ff',
                            300: '#7cc7ff',
                            400: '#36a9ff',
                            500: '#0090ff',
                            600: '#0070f3',
                            700: '#0058cc',
                            800: '#0047a6',
                            900: '#003380',
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .dark .glass-effect {
            background: rgba(17, 24, 39, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        :root {
            --primary-color: #b362fc;
            --secondary-color: #cd53f4;
        }
        .theme-purple {
            --primary-color: #b362fc;
            --secondary-color: #cd53f4;
        }
        .theme-blue {
            --primary-color: #3b82f6;
            --secondary-color: #60a5fa;
        }
        .theme-green {
            --primary-color: #10b981;
            --secondary-color: #34d399;
        }
        .theme-orange {
            --primary-color: #f97316;
            --secondary-color: #fb923c;
        }
        .theme-pink {
            --primary-color: #ec4899;
            --secondary-color: #f472b6;
        }
        .theme-gradient {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }
        .theme-text {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
    <!-- Mobile Menu Button -->
    <button 
        onclick="toggleSidebar()"
        class="md:hidden fixed top-4 left-4 z-50 p-2 rounded-lg bg-white dark:bg-gray-800 shadow-lg"
    >
        <i data-lucide="menu" class="w-6 h-6 dark:text-white"></i>
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out w-64 glass-effect z-30">
        <div class="p-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 theme-gradient rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="zap" class="w-6 h-6 text-white"></i>
                </div>
                <h1 class="text-xl font-bold theme-text">CopyWave</h1>
            </div>
        </div>

        <nav class="mt-2">
            <div class="px-4 space-y-2">
                <a href="#" class="flex items-center space-x-3 p-3 theme-gradient text-white rounded-xl font-medium">
                    <i data-lucide="layout-grid" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/30 rounded-xl transition-colors duration-150">
                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                    <span>Gestão de planos</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/30 rounded-xl transition-colors duration-150">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span>Páginas</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/30 rounded-xl transition-colors duration-150">
                    <i data-lucide="globe" class="w-5 h-5"></i>
                    <span>Gerenciar Domínios</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/30 rounded-xl transition-colors duration-150">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span>Gestão de Usuários</span>
                </a>
            </div>

            <!-- User Profile Card -->
            <div class="absolute bottom-20 left-0 right-0 p-4">
                <div onclick="toggleUserModal()" class="bg-white/50 dark:bg-gray-700/50 rounded-xl p-4 cursor-pointer backdrop-blur-sm hover:bg-white/70 dark:hover:bg-gray-700/70 transition-colors duration-150">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 theme-gradient rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-sm font-bold text-white">PV</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Pedro Vinicius</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Administrador</p>
                        </div>
                        <i data-lucide="settings" class="w-4 h-4 text-gray-400 dark:text-gray-500"></i>
                    </div>
                </div>
            </div>

            <!-- Theme Toggle Button -->
            <div class="absolute bottom-4 left-0 right-0 px-4">
                <button 
                    onclick="toggleTheme()"
                    class="w-full p-3 rounded-xl bg-white/50 dark:bg-gray-700/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-gray-700/70 transition-colors duration-150 flex items-center justify-center space-x-2"
                >
                    <i data-lucide="sun" class="w-5 h-5 dark:hidden"></i>
                    <i data-lucide="moon" class="w-5 h-5 hidden dark:block text-white"></i>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Alternar Tema</span>
                </button>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="md:ml-64 p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Lista de Páginas</h2>
            <button class="theme-gradient text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover:opacity-90 transition-opacity duration-150">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Criar Página</span>
            </button>
        </div>

        <!-- Page Card -->
        <div class="glass-effect rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Pedro vinicius de souza novais</h3>
                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-sm">Ativo</span>
                </div>
            </div>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">9e71233a-3521-428f-bd70-26ac025ebcef</p>
            <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-300">
                <span class="flex items-center space-x-1">
                    <i data-lucide="eye" class="w-4 h-4"></i>
                    <span>1</span>
                </span>
                <a href="http://google.com.br" class="theme-text hover:underline flex items-center space-x-1">
                    <i data-lucide="link" class="w-4 h-4"></i>
                    <span>http://google.com.br</span>
                </a>
            </div>
        </div>
    </main>

    <!-- User Modal -->
    <div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="glass-effect rounded-2xl p-6 max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Minha Conta</h3>
                <button onclick="toggleUserModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-16 h-16 theme-gradient rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-2xl font-bold text-white">PV</span>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white">Pedro Vinicius</h4>
                    <h5 class="text-lg font-bold text-gray-900 dark:text-white">Administrador</h5>
                </div>
            </div>
            <div class="space-y-4 mb-6">
                <div class="flex items-center space-x-3 text-gray-600 dark:text-gray-300">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                    <span>pedro@example.com</span>
                </div>
            </div>

            <!-- Color Theme Selection -->
            <div class="space-y-4">
                <h4 class="font-semibold text-gray-900 dark:text-white">Tema de Cores</h4>
                <div class="grid grid-cols-5 gap-3">
                    <button onclick="setColorTheme('purple')" class="w-full h-10 bg-gradient-to-r from-[#b362fc] to-[#cd53f4] rounded-lg"></button>
                    <button onclick="setColorTheme('blue')" class="w-full h-10 bg-gradient-to-r from-[#3b82f6] to-[#60a5fa] rounded-lg"></button>
                    <button onclick="setColorTheme('green')" class="w-full h-10 bg-gradient-to-r from-[#10b981] to-[#34d399] rounded-lg"></button>
                    <button onclick="setColorTheme('orange')" class="w-full h-10 bg-gradient-to-r from-[#f97316] to-[#fb923c] rounded-lg"></button>
                    <button onclick="setColorTheme('pink')" class="w-full h-10 bg-gradient-to-r from-[#ec4899] to-[#f472b6] rounded-lg"></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Theme Toggle
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            
            if (isDark) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }

        // Set initial theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Color Theme Management
        function setColorTheme(theme) {
            document.body.className = document.body.className.replace(/theme-\w+/, '');
            document.body.classList.add(`theme-${theme}`);
            localStorage.setItem('colorTheme', theme);
        }

        // Set initial color theme
        const savedColorTheme = localStorage.getItem('colorTheme') || 'purple';
        setColorTheme(savedColorTheme);

        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // User modal toggle
        function toggleUserModal() {
            const modal = document.getElementById('userModal');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebar');
            const sidebarButton = document.querySelector('[onclick="toggleSidebar()"]');
            
            if (!sidebar.contains(e.target) && !sidebarButton.contains(e.target) && !sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>
</html>