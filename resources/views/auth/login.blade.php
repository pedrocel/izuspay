<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Izus Payment</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#1e40af',
                        'secondary-blue': '#3b82f6',
                        'accent-blue': '#60a5fa',
                        'dark-blue': '#1e3a8a',
                        'light-blue': '#dbeafe'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'fade-in': 'fadeIn 1s ease-out',
                        'secure-pulse': 'securePulse 2s infinite',
                        'connection-pulse': 'connectionPulse 1.5s infinite'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' }
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        securePulse: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                            '50%': { transform: 'scale(1.1)', opacity: '0.8' }
                        },
                        connectionPulse: {
                            '0%, 100%': { opacity: '0.3', transform: 'scale(0.8)' },
                            '50%': { opacity: '1', transform: 'scale(1.2)' }
                        }
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
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 25%, #60a5fa 50%, #3b82f6 75%, #1e40af 100%);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Tela de conexão segura */
        .connection-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
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
            color: #60a5fa;
            animation: secure-pulse 2s infinite;
            margin-bottom: 2rem;
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
            background: #60a5fa;
            animation: connection-pulse 1.5s infinite;
        }

        .connection-dot:nth-child(2) { animation-delay: 0.3s; }
        .connection-dot:nth-child(3) { animation-delay: 0.6s; }

        .security-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(96, 165, 250, 0.1);
            border: 1px solid #60a5fa;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            margin-top: 1rem;
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from { box-shadow: 0 0 10px rgba(96, 165, 250, 0.3); }
            to { box-shadow: 0 0 20px rgba(96, 165, 250, 0.6); }
        }

        /* Container do login */
        .login-container {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-container.show {
            opacity: 1;
            transform: translateY(0);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px rgba(30, 64, 175, 0.15);
            border: 1px solid rgba(96, 165, 250, 0.2);
        }

        .form-group input {
            background: rgba(248, 250, 252, 0.8);
            border-color: #e2e8f0;
            color: #1e293b;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-group input::placeholder {
            color: #64748b;
        }

        .form-group input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: rgba(255, 255, 255, 0.95);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
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
            box-shadow: 0 15px 30px rgba(59, 130, 246, 0.4);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .loading-spinner {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: #ffffff;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

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

        .floating-elements {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            background: rgba(96, 165, 250, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 15%;
            left: 20%;
            animation-delay: 4s;
        }

        .floating-element:nth-child(4) {
            width: 40px;
            height: 40px;
            bottom: 30%;
            right: 10%;
            animation-delay: 1s;
        }

        .security-indicators {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .security-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            color: #059669;
            font-weight: 500;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg relative overflow-hidden">
    
    <!-- Elementos flutuantes de fundo -->
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>

    <!-- Tela de conexão segura -->
    <div id="connection-screen" class="connection-screen">
        <div class="text-center">
            <i class="fas fa-shield-alt secure-icon"></i>
            <h2 class="text-2xl font-bold text-white mb-4">Conectando ao Servidor Seguro</h2>
            <p class="text-blue-200 mb-6">Estabelecendo conexão criptografada com Izus Payment...</p>
            
            <div class="connection-dots">
                <div class="connection-dot"></div>
                <div class="connection-dot"></div>
                <div class="connection-dot"></div>
            </div>
            
            <div class="security-badge">
                <i class="fas fa-lock text-accent-blue"></i>
                <span class="text-white text-sm">SSL 256-bit Encryption</span>
            </div>
        </div>
    </div>

    <!-- Container principal do login -->
    <div id="login-container" class="login-container flex items-center justify-center min-h-screen p-4 relative z-10">
        <div class="glass-effect rounded-2xl shadow-2xl p-8 lg:p-12 w-full max-w-md">
            
            <!-- Logo e título -->
            <div class="text-center mb-10">
                <div class="flex items-center justify-center mx-auto mb-6 ">
                    <div class="flex-grow">
                        <img class="rounded-lg" src="/img/izus.png" alt="Izus Payment Logo">
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Entre em sua conta para acessar</p>
            </div>

            <!-- Indicadores de segurança -->
           
            
            <!-- Mensagens de erro (integrado do código antigo) -->
            @if ($errors->any())
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 rounded-lg p-4 fade-in">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    <h3 class="text-red-800 font-semibold text-sm">Erro no login</h3>
                </div>
                <ul class="text-red-700 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                    <li class="flex items-center">
                        <i class="fas fa-circle text-red-500 text-xs mr-2"></i>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Formulário de login -->
            <form method="POST" action="{{ route('login') }}" id="login-form" novalidate>
                @csrf
                
                <div class="form-group mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        E-mail
                    </label>
                    <div class="relative">
                        <input id="email" 
                               name="email" 
                               type="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               class="w-full px-4 py-4 pl-12 border-2 rounded-xl focus:outline-none transition-all text-base"
                               placeholder="seu@email.com">
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-secondary-blue"></i>
                    </div>
                    @error('email')
                        <div class="error-message text-xs mt-1 show" id="email-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Senha
                    </label>
                    <div class="relative">
                        <input id="password" 
                               name="password" 
                               type="password" 
                               required 
                               autocomplete="current-password"
                               class="w-full px-4 py-4 pl-12 pr-12 border-2 rounded-xl focus:outline-none transition-all text-base"
                               placeholder="••••••••">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-secondary-blue"></i>
                        <button type="button" 
                                onclick="togglePassword()" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-secondary-blue transition-colors">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-message text-xs mt-1 show" id="password-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <input id="remember" 
                               name="remember" 
                               type="checkbox" 
                               {{ old('remember') ? 'checked' : '' }}
                               class="h-4 w-4 text-secondary-blue focus:ring-secondary-blue border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700 font-medium">
                            Lembrar de mim
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-sm text-secondary-blue hover:text-primary-blue font-medium transition-colors">
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
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500 font-medium">ou</span>
                </div>
            </div>
            
            <div class="text-center">
                <p class="text-gray-600">
                    Não tem uma conta?
                    <a href="{{ route('association.register.form') }}" 
                       class="text-secondary-blue hover:text-primary-blue font-semibold transition-colors ml-1">
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
            
            // Função para alternar visibilidade da senha
            window.togglePassword = function() {
                const passwordField = document.getElementById('password');
                const passwordIcon = document.getElementById('password-icon');
                
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    passwordIcon.classList.remove('fa-eye');
                    passwordIcon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    passwordIcon.classList.remove('fa-eye-slash');
                    passwordIcon.classList.add('fa-eye');
                }
            };

            // Adicionar validação de formulário básica (se necessário, ou confiar no Laravel)
            const loginForm = document.getElementById('login-form');
            loginForm.addEventListener('submit', function(event) {
                // Esta validação é mais para feedback instantâneo no cliente.
                // A validação principal deve ser feita no servidor Laravel.
                let isValid = true;

                // Validação de Email
                const emailInput = document.getElementById('email');
                const emailError = document.getElementById('email-error');
                if (!emailInput.value || !emailInput.value.includes('@')) {
                    emailInput.closest('.form-group').classList.add('error');
                    emailError.textContent = 'Por favor, insira um e-mail válido.';
                    emailError.classList.add('show');
                    isValid = false;
                } else {
                    emailInput.closest('.form-group').classList.remove('error');
                    emailError.classList.remove('show');
                }

                // Validação de Senha
                const passwordInput = document.getElementById('password');
                const passwordError = document.getElementById('password-error');
                if (!passwordInput.value || passwordInput.value.length < 6) {
                    passwordInput.closest('.form-group').classList.add('error');
                    passwordError.textContent = 'A senha deve ter pelo menos 6 caracteres.';
                    passwordError.classList.add('show');
                    isValid = false;
                } else {
                    passwordInput.closest('.form-group').classList.remove('error');
                    passwordError.classList.remove('show');
                }

                if (!isValid) {
                    event.preventDefault(); // Impede o envio do formulário se a validação falhar
                }
            });

            // Remover classes de erro ao digitar
            document.getElementById('email').addEventListener('input', function() {
                this.closest('.form-group').classList.remove('error');
                document.getElementById('email-error').classList.remove('show');
            });
            document.getElementById('password').addEventListener('input', function() {
                this.closest('.form-group').classList.remove('error');
                document.getElementById('password-error').classList.remove('show');
            });
        });
    </script>
</body>
</html>

