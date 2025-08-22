<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Lux Secrets</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: {
                            50: '#f9fafb',
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827',
                            950: '#030712'
                        },
                        pink: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            200: '#fbcfe8',
                            300: '#f9a8d4',
                            400: '#f472b6',
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                            800: '#9d174d',
                            900: '#831843'
                        },
                        // Cores personalizadas da imagem
                        'main-bg': '#1f1e29',
                        'sidebar-bg': '#191823',
                        'card-bg': '#2b2a3a',
                        'accent-pink': '#ec4899',
                        'text-light': '#e5e5e5',
                        'text-dark-gray': '#a0aec0',
                        'lux-purple': '#621d62',
                        'lux-magenta': '#ff00ff',
                        'lux-dark': '#0a0a0a',
                        'lux-gray': '#1a1a1a',
                        'lux-light': '#f5f5f5',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #621d62 0%, #000000 100%);
        }

        /* Animações de conexão segura */
        .connection-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #621d62 0%, #000000 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }

        .connection-screen.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .secure-icon {
            font-size: 4rem;
            color: #ff00ff;
            animation: pulse-secure 2s infinite;
            margin-bottom: 2rem;
        }

        @keyframes pulse-secure {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .connection-dots {
            display: flex;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .connection-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ff00ff;
            animation: connection-pulse 1.5s infinite;
        }

        .connection-dot:nth-child(2) { animation-delay: 0.3s; }
        .connection-dot:nth-child(3) { animation-delay: 0.6s; }

        @keyframes connection-pulse {
            0%, 100% { opacity: 0.3; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.2); }
        }

        .security-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 0, 255, 0.1);
            border: 1px solid #ff00ff;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            margin-top: 1rem;
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from { box-shadow: 0 0 10px rgba(255, 0, 255, 0.3); }
            to { box-shadow: 0 0 20px rgba(255, 0, 255, 0.6); }
        }

        /* Estilos do formulário com identidade Lux Secrets */
        .login-container {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-container.show {
            opacity: 1;
            transform: translateY(0);
        }

        .card-effect {
            background: rgba(26, 26, 26, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 40px rgba(98, 29, 98, 0.3);
            border: 1px solid rgba(255, 0, 255, 0.2);
        }

        .form-group input {
            background: rgba(10, 10, 10, 0.8);
            border-color: #621d62;
            color: #f5f5f5;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-group input::placeholder {
            color: #888;
        }

        .form-group input:focus {
            border-color: #ff00ff;
            box-shadow: 0 0 0 3px rgba(255, 0, 255, 0.2);
            background: rgba(10, 10, 10, 0.95);
        }

        .btn-primary {
            background: linear-gradient(135deg, #621d62 0%, #ff00ff 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(255, 0, 255, 0.4);
        }

        .loading-spinner {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: #ff00ff;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .fade-in {
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Estilos específicos para o tema escuro */
        .form-group.error input {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-group.success input {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }
        
        .error-message {
            color: #ef4444;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .error-message.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .notification {
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .notification.show {
            transform: translateX(0);
        }
    </style>
</head>
<body class="min-h-screen relative overflow-x-hidden">
    
    <!-- Tela de conexão segura -->
    <div id="connection-screen" class="connection-screen">
        <div class="text-center">
            <i class="fas fa-shield-alt secure-icon"></i>
            <h2 class="text-2xl font-bold text-white mb-4">Conectando ao Servidor Seguro</h2>
            <p class="text-gray-300 mb-6">Estabelecendo conexão criptografada...</p>
            
            <div class="connection-dots">
                <div class="connection-dot"></div>
                <div class="connection-dot"></div>
                <div class="connection-dot"></div>
            </div>
            
            <div class="security-badge">
                <i class="fas fa-lock text-lux-magenta"></i>
                <span class="text-white text-sm">SSL 256-bit Encryption</span>
            </div>
        </div>
    </div>

    <!-- Container principal do login -->
    <div id="login-container" class="login-container flex items-center justify-center min-h-screen p-4">
        <div class="card-effect rounded-2xl shadow-2xl p-8 lg:p-12 w-full max-w-md">
            
            <div class="text-center mb-10">
                <div class="flex items-center justify-center mx-auto mb-6">
                    <!-- Espaço para logo do Lux Secrets -->
                    <div class="w-48  justify-center">
                        <img class="text-white text-xl" src="https://i.ibb.co/0pNpWH61/image-removebg-preview-1.png">
                    </div>
                </div>
            </div>
            
            @if ($errors->any())
            <div class="mb-8 bg-red-900/20 border-l-4 border-red-500 rounded-xl p-6 fade-in">
                <div class="flex items-center mb-3">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                    <h3 class="text-red-400 font-semibold">Erro no login</h3>
                </div>
                <ul class="text-red-300 space-y-2">
                    @foreach ($errors->all() as $error)
                    <li class="flex items-center">
                        <i class="fas fa-circle text-red-400 text-xs mr-2"></i>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}" id="login-form" novalidate>
                @csrf
                
                <div class="form-group mb-6">
                    <label for="email" class="block text-sm font-semibold text-white mb-2">
                    </label>
                    <div class="relative">
                        <input id="email" 
                               name="email" 
                               type="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               class="w-full px-4 py-4 pl-12 border rounded-xl focus:outline-none transition-all text-lg"
                               placeholder="seu@email.com">
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-lux-magenta"></i>
                    </div>
                </div>
                
                <div class="form-group mb-6">
                    <label for="password" class="block text-sm font-semibold text-white mb-2">
                    </label>
                    <div class="relative">
                        <input id="password" 
                               name="password" 
                               type="password" 
                               required 
                               autocomplete="current-password"
                               class="w-full px-4 py-4 pl-12 pr-12 border rounded-xl focus:outline-none transition-all text-lg"
                               placeholder="••••••••">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-lux-magenta"></i>
                        <button type="button" 
                                onclick="togglePassword()" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-lux-magenta transition-colors">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <input id="remember" 
                               name="remember" 
                               type="checkbox" 
                               {{ old('remember') ? 'checked' : '' }}
                               class="h-5 w-5 text-lux-magenta focus:ring-lux-magenta border-lux-purple rounded bg-lux-gray">
                        <label for="remember" class="ml-3 block text-sm text-gray-300 font-medium">
                            Salvar Login(Somente Dispositivo confiável).
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-sm text-lux-magenta hover:underline font-medium transition-colors">
                        Esqueceu a senha?
                    </a>
                    @endif
                </div>
                
                <button type="submit" 
                        class="btn-primary w-full text-white font-semibold py-4 px-6 rounded-xl text-lg mb-6" 
                        id="login-btn">
                    <span id="login-text">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Entrar
                    </span>
                </button>
            </form>
            
            <div class="relative mb-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-lux-purple"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-lux-gray text-gray-300 font-medium">ou</span>
                </div>
            </div>
            
            <div class="text-center">
                <p class="text-gray-300">
                    Não tem uma conta?
                    <a href="{{ route('association.register.form') }}" 
                       class="text-lux-magenta hover:underline font-semibold transition-colors ml-1">
                        Criar agora
                    </a>
                </p>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const connectionScreen = document.getElementById('connection-screen');
            const loginContainer = document.getElementById('login-container');
            
            // Simular conexão segura
            setTimeout(() => {
                connectionScreen.classList.add('hidden');
                setTimeout(() => {
                    loginContainer.classList.add('show');
                    document.getElementById('email').focus();
                }, 500);
            }, 3000);
            
            // Inicializar formulário
            new LoginForm();
        });

        class LoginForm {
            constructor() {
                this.form = document.getElementById('login-form');
                this.emailField = document.getElementById('email');
                this.passwordField = document.getElementById('password');
                this.loginBtn = document.getElementById('login-btn');
                this.loginText = document.getElementById('login-text');
                
                this.init();
            }
            
            init() {
                this.setupEventListeners();
            }
            
            setupEventListeners() {
                this.form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleSubmit();
                });
            }
            
            handleSubmit() {
                this.showLoading();
                
                setTimeout(() => {
                    this.form.submit();
                }, 1000);
            }
            
            showLoading() {
                this.loginBtn.disabled = true;
                this.loginText.innerHTML = '<div class="loading-spinner w-5 h-5 border-2 rounded-full mr-2"></div> Entrando...';
            }
        }
        
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordField.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }
    </script>
</body>
</html>
