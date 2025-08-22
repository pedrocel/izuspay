    <!DOCTYPE html>
    <html lang="pt-BR" class="light">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Copywave') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                            
                        },
                        backdropBlur: {
                            'xs': '2px',
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
        <!-- Theme Toggle Button (Floating) -->
        <button 
            onclick="toggleTheme()"
            class="fixed bottom-4 right-4 z-50 p-3 rounded-xl glass-effect hover:opacity-90 transition-all duration-150 shadow-lg"
        >
            <i data-lucide="sun" class="w-5 h-5 dark:hidden"></i>
            <i data-lucide="moon" class="w-5 h-5 hidden dark:block text-white"></i>
        </button>

        <!-- Mobile Menu Button -->
        <button 
            onclick="toggleSidebar()"
            class="md:hidden fixed top-4 left-4 z-50 p-2 rounded-lg bg-white dark:bg-gray-800 shadow-lg"
        >
            <i data-lucide="menu" class="w-6 h-6 dark:text-white"></i>
        </button>

        @php
            use Illuminate\Support\Facades\Auth;
            $user = Auth::user();
        @endphp
        <!-- User Profile Modal -->
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
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{$user->name}}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->perfilAtual()->name }}</p>
                    </div>
                </div>
                <div class="space-y-4 mb-6">
                    <div class="flex items-center space-x-3 text-gray-600 dark:text-gray-300">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                        <span>{{$user->email}}</span>
                    </div>
                </div>

                <!-- Color Theme Selection -->
                <div class="space-y-4 mb-6">
                    <h4 class="font-semibold text-gray-900 dark:text-white">Tema de Cores</h4>
                    <div class="grid grid-cols-5 gap-3">
                        <button onclick="setColorTheme('purple')" class="w-full h-10 bg-gradient-to-r from-[#b362fc] to-[#cd53f4] rounded-lg"></button>
                        <button onclick="setColorTheme('blue')" class="w-full h-10 bg-gradient-to-r from-[#3b82f6] to-[#60a5fa] rounded-lg"></button>
                        <button onclick="setColorTheme('green')" class="w-full h-10 bg-gradient-to-r from-[#10b981] to-[#34d399] rounded-lg"></button>
                        <button onclick="setColorTheme('orange')" class="w-full h-10 bg-gradient-to-r from-[#f97316] to-[#fb923c] rounded-lg"></button>
                        <button onclick="setColorTheme('pink')" class="w-full h-10 bg-gradient-to-r from-[#ec4899] to-[#f472b6] rounded-lg"></button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-3">
                    <button onclick="window.location.href='/subscription'" class="flex items-center justify-center space-x-2 p-3 rounded-xl bg-white/50 dark:bg-gray-700/50 hover:bg-white/70 dark:hover:bg-gray-700/70 transition-colors duration-150">
                        <i data-lucide="credit-card" class="w-5 h-5 text-purple-500"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Gerenciar Assinatura</span>
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center justify-center space-x-2 p-3 rounded-xl bg-white/50 dark:bg-gray-700/50 hover:bg-white/70 dark:hover:bg-gray-700/70 transition-colors duration-150">
                            <i data-lucide="power" class="w-5 h-5 text-red-500"></i>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Sair</span>
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="flex h-screen">
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

            <nav class="flex flex-col h-[calc(100%-96px)]">
                <div class="px-4 space-y-2">
                    <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/30 rounded-xl transition-colors duration-150">
                        <i data-lucide="layout-grid" class="w-5 h-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="flex items
                    -center space-x-3 p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/30 rounded-xl transition-colors duration-150">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                        <span>Gestão de planos</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-3 theme-gradient text-white rounded-xl font-medium">
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

                <!-- User Profile Section -->
                <div class="mt-auto p-4">
                    <!-- Plan Status Card -->
                    {{-- <div class="bg-white/50 dark:bg-gray-700/50 rounded-xl p-3 backdrop-blur-sm mb-3">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <i data-lucide="crown" class="w-5 h-5 text-yellow-500"></i>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">Plano Pro</span>
                            </div>
                            <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-xs">Ativo</span>
                        </div>
                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            Próxima cobrança em 15 dias
                        </div>
                    </div> --}}

                    <!-- User Profile Card -->
                    <div onclick="toggleUserModal()" class="bg-white/50 dark:bg-gray-700/50 rounded-xl p-3 cursor-pointer backdrop-blur-sm hover:bg-white/70 dark:hover:bg-gray-700/70 transition-colors duration-150">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 theme-gradient rounded-xl flex items-center justify-center shadow-lg">
                                <span class="text-sm font-bold text-white">{{ Str::substr($user->name, 0, 2) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->perfilAtual()->name}}</p>
                            </div>
                            <i data-lucide="settings" class="w-4 h-4 text-gray-400 dark:text-gray-500"></i>
                        </div>
                    </div>
                    </div>
                </nav>
            </aside>
            <main class="flex-1 overflow-y-auto md:ml-64">
                @yield('content')
            </main>
        </div>

        <script>
            // SweetAlert Mensagens
            const successMessage = "{{ session('success') ?? '' }}";
            const errorMessage = "{{ session('error') ?? '' }}";

            if (successMessage.trim() !== '') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: successMessage,
                    timer: 3000,
                    showConfirmButton: false
                });
            }

            if (errorMessage.trim() !== '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: errorMessage,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        </script>

        <script>
            
            // Inicializar Select2
            $(document).ready(function() {
                $('#controllers').select2({
                    placeholder: "Selecione controladores",
                    allowClear: true
                });
            });
        </script>
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

            // Remove modification
            function removeModification(button) {
                button.closest('.modification').remove();
                updateModificationIndexes();
            }

            // Update modification indexes after removal
            function updateModificationIndexes() {
                const container = document.getElementById('modifications-container');
                const modifications = container.getElementsByClassName('modification');
                
                Array.from(modifications).forEach((mod, index) => {
                    const select = mod.querySelector('select');
                    const inputs = mod.querySelectorAll('input');
                    
                    select.name = `modifications[${index}][type]`;
                    inputs[0].name = `modifications[${index}][old_value]`;
                    inputs[1].name = `modifications[${index}][new_value]`;
                });
            }

            // Add modification field
            document.getElementById('add-modification').addEventListener('click', function() {
                const container = document.getElementById('modifications-container');
                const index = container.children.length;
                const div = document.createElement('div');
                div.className = 'modification grid grid-cols-1 md:grid-cols-7 gap-4 items-center';
                div.innerHTML = `
                    <select name="modifications[${index}][type]" class="col-span-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                        <option value="link">Link</option>
                        <option value="image">Imagem</option>
                        <option value="script">Script</option>
                    </select>
                    <input type="text" name="modifications[${index}][old_value]" placeholder="Valor Antigo" class="col-span-2 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                    <input type="text" name="modifications[${index}][new_value]" placeholder="Novo Valor" class="col-span-2 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                    <button type="button" onclick="removeModification(this)" class="col-span-1 px-3 py-2 rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-500 transition-colors duration-150">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                `;
                container.appendChild(div);
                lucide.createIcons();
            });

            // Form submission
            document.getElementById('createPageForm').addEventListener('submit', function(e) {
                e.preventDefault();
                // Add your form submission logic here
                console.log('Form submitted');
            });

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