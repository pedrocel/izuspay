<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izus Pay - Gateway de Pagamentos Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        'primary': '#0066FF',
                        'primary-dark': '#0052CC',
                        'secondary': '#00D4FF',
                        'accent': '#FF6B35',
                        'dark': '#0A0A0A',
                        'dark-light': '#1A1A1A',
                        'dark-lighter': '#2A2A2A',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'scale-in': 'scaleIn 0.4s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        scaleIn: {
                            '0%': { transform: 'scale(0.9)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-dark text-white font-inter overflow-x-hidden">
    <nav class="fixed top-0 w-full z-50 bg-dark/80 backdrop-blur-xl border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <div class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        Izus Pay
                    </div>
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('show.docs') }}" class="text-gray-300 hover:text-white transition-colors">Documentação</a>
                        <a href="#support" class="text-gray-300 hover:text-white transition-colors">Suporte</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors">Login</a>
                    <a href="{{ route('show.docs') }}" class="bg-primary hover:bg-primary-dark px-6 py-2 rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                        Integrar API
                    </a>
                </div>
            </div>
        </div>
    </nav>
{{--  --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary/20 via-transparent to-secondary/20"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(0,102,255,0.1),transparent_50%)]"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="animate-fade-in">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black mb-8 leading-tight">
                    <span class="bg-gradient-to-r from-white via-primary to-secondary bg-clip-text text-transparent">
                        Simplificando o faturamento do 
                    <br>
                    <span class="text-white">seu negócio</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                    A plataforma de pagamentos mais avançada do Brasil. PIX instantâneo, cartões globais, 
                    APIs robustas e segurança bancária.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="{{ route('association.register') }}" class="bg-primary hover:bg-primary-dark px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-primary/25">
                        Começar Agora
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute top-20 left-10 w-20 h-20 bg-primary/20 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-secondary/20 rounded-full animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute top-1/2 left-20 w-16 h-16 bg-accent/20 rounded-full animate-float" style="animation-delay: -4s;"></div>
    </section>

    {{-- <section class="py-20 bg-dark-light">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center animate-scale-in">
                    <div class="text-4xl md:text-5xl font-black text-primary mb-2" data-counter="50000">0</div>
                    <div class="text-gray-400">Transações/dia</div>
                </div>
                <div class="text-center animate-scale-in" style="animation-delay: 0.1s;">
                    <div class="text-4xl md:text-5xl font-black text-secondary mb-2" data-counter="99.9">0</div>
                    <div class="text-gray-400">% Uptime</div>
                </div>
                <div class="text-center animate-scale-in" style="animation-delay: 0.2s;">
                    <div class="text-4xl md:text-5xl font-black text-accent mb-2" data-counter="2000">0</div>
                    <div class="text-gray-400">Empresas</div>
                </div>
                <div class="text-center animate-scale-in" style="animation-delay: 0.3s;">
                    <div class="text-4xl md:text-5xl font-black text-primary mb-2" data-counter="24">0</div>
                    <div class="text-gray-400">Países</div>
                </div>
            </div>
        </div>
    </section> --}}



    <section id="integrations" class="py-32 bg-dark-light">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-6xl font-black mb-6">
                    <span class="bg-gradient-to-r from-secondary to-primary bg-clip-text text-transparent">
                        Integrações Poderosas
                    </span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Conecte-se com as principais plataformas do mercado
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 mb-16">
                <div class="bg-dark border border-white/10 rounded-xl p-6 flex items-center justify-center hover:border-primary/50 transition-all duration-300 hover:scale-105">
                    <div class="text-3xl font-bold text-gray-400">Shopify</div>
                </div>
                <div class="bg-dark border border-white/10 rounded-xl p-6 flex items-center justify-center hover:border-primary/50 transition-all duration-300 hover:scale-105">
                    <div class="text-3xl font-bold text-gray-400">WooCommerce</div>
                </div>
                <div class="bg-dark border border-white/10 rounded-xl p-6 flex items-center justify-center hover:border-primary/50 transition-all duration-300 hover:scale-105">
                    <div class="text-3xl font-bold text-gray-400">Magento</div>
                </div>
                <div class="bg-dark border border-white/10 rounded-xl p-6 flex items-center justify-center hover:border-primary/50 transition-all duration-300 hover:scale-105">
                    <div class="text-3xl font-bold text-gray-400">Prestashop</div>
                </div>
                <div class="bg-dark border border-white/10 rounded-xl p-6 flex items-center justify-center hover:border-primary/50 transition-all duration-300 hover:scale-105">
                    <div class="text-3xl font-bold text-gray-400">Vtex</div>
                </div>
                <div class="bg-dark border border-white/10 rounded-xl p-6 flex items-center justify-center hover:border-primary/50 transition-all duration-300 hover:scale-105">
                    <div class="text-3xl font-bold text-gray-400">Nuvemshop</div>
                </div>
            </div>

            <div class="text-center">
                <button onclick="openApiModal()" class="bg-gradient-to-r from-primary to-secondary hover:from-primary-dark hover:to-primary px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105">
                    Ver Todas as Integrações
                </button>
            </div>
        </div>
    </section>

    <section class="py-32 bg-dark">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-6xl font-black mb-6">
                    <span class="bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
                        Para Todos os Negócios
                    </span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Soluções personalizadas para cada segmento
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gradient-to-br from-primary/10 to-secondary/10 border border-primary/20 rounded-2xl p-8 hover:border-primary/50 transition-all duration-500">
                    <i class="fas fa-shopping-cart text-4xl text-primary mb-6"></i>
                    <h3 class="text-2xl font-bold mb-4">E-commerce</h3>
                    <p class="text-gray-400">Checkout otimizado, recuperação de carrinho abandonado e análise de conversão.</p>
                </div>

                <div class="bg-gradient-to-br from-secondary/10 to-accent/10 border border-secondary/20 rounded-2xl p-8 hover:border-secondary/50 transition-all duration-500">
                    <i class="fas fa-utensils text-4xl text-secondary mb-6"></i>
                    <h3 class="text-2xl font-bold mb-4">Food & Delivery</h3>
                    <p class="text-gray-400">Pagamentos rápidos, split de comissões e integração com apps de delivery.</p>
                </div>

                <div class="bg-gradient-to-br from-accent/10 to-primary/10 border border-accent/20 rounded-2xl p-8 hover:border-accent/50 transition-all duration-500">
                    <i class="fas fa-graduation-cap text-4xl text-accent mb-6"></i>
                    <h3 class="text-2xl font-bold mb-4">Educação</h3>
                    <p class="text-gray-400">Assinaturas recorrentes, parcelamento sem juros e gestão de inadimplência.</p>
                </div>

                <div class="bg-gradient-to-br from-primary/10 to-accent/10 border border-primary/20 rounded-2xl p-8 hover:border-primary/50 transition-all duration-500">
                    <i class="fas fa-heartbeat text-4xl text-primary mb-6"></i>
                    <h3 class="text-2xl font-bold mb-4">Saúde</h3>
                    <p class="text-gray-400">Conformidade LGPD, pagamentos seguros e integração com sistemas médicos.</p>
                </div>
            </div>
        </div>
    </section>

   

    <section id="support" class="py-32 bg-dark">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-6xl font-black mb-6">
                    <span class="bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent">
                        Suporte Excepcional
                    </span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Nossa equipe está sempre pronta para ajudar você
                </p>
            </div>

            <div class="grid md:grid-cols-1 gap-8 mb-16">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-headset text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Agente de contas </h3>
                    <p class="text-gray-400">Agente personalizado para seu negócio.</p>
                </div>


            </div>

            <div class="text-center">
                <div class="inline-flex space-x-4">
                    <button class="bg-primary hover:bg-primary-dark px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-comments mr-2"></i>
                        Iniciar Chat
                    </button>
                    <a href="{{ route('show.docs') }}" class="border border-white/20 hover:border-primary px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-book mr-2"></i>
                        Ver Documentação
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-32 bg-gradient-to-br from-primary/20 via-dark to-secondary/20">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-6xl font-black mb-8">
                <span class="bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                    Pronto para Revolucionar
                </span>
                <br>
                <span class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    Seus Pagamentos?
                </span>
            </h2>
            <p class="text-xl text-gray-300 mb-12 leading-relaxed">
                Junte-se a milhares de empresas que já escolheram o Izus Pay. 
                Comece gratuitamente e veja a diferença em minutos.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="{{ route('association.register') }}" class="bg-primary hover:bg-primary-dark px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-primary/25">
                        Começar Agora
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark-light border-t border-white/10 py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="text-3xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-6">
                        Izus Pay
                    </div>
                    <p class="text-gray-400 mb-6">
                        O gateway de pagamentos mais avançado do Brasil. Seguro, rápido e confiável.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center hover:bg-primary/30 transition-colors">
                            <i class="fab fa-twitter text-primary"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center hover:bg-primary/30 transition-colors">
                            <i class="fab fa-linkedin text-primary"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center hover:bg-primary/30 transition-colors">
                            <i class="fab fa-github text-primary"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-6">Produto</h4>
                    <ul class="space-y-3">
                        <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Recursos</a></li>
                        <li><a href="#pricing" class="text-gray-400 hover:text-white transition-colors">Preços</a></li>
                        <li><a href="#integrations" class="text-gray-400 hover:text-white transition-colors">Integrações</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Changelog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-6">Desenvolvedores</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('show.docs') }}" class="text-gray-400 hover:text-white transition-colors">Documentação</a></li>
                      
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-6">Empresa</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Sobre</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Carreiras</a></li>
                        <li><a href="#support" class="text-gray-400 hover:text-white transition-colors">Contato</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-400 mb-4 md:mb-0">
                    © 2025 Izus Pay. Todos os direitos reservados.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacidade</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Termos</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <div id="apiModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-dark-light border border-white/20 rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b border-white/10">
                    <h2 class="text-2xl font-bold">Documentação da API</h2>
                    <button onclick="closeApiModal()" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="flex h-[calc(90vh-80px)]">
                    <div class="w-1/3 border-r border-white/10 p-6 overflow-y-auto">
                        <nav class="space-y-2">
                            <button onclick="showApiSection('quickstart')" class="api-nav-btn w-full text-left px-4 py-2 rounded-lg hover:bg-white/5 transition-colors">
                                <i class="fas fa-rocket mr-2"></i>Quick Start
                            </button>
                            {{-- <button onclick="showApiSection('authentication')" class="api-nav-btn w-full text-left px-4 py-2 rounded-lg hover:bg-white/5 transition-colors">
                                <i class="fas fa-key mr-2"></i>Autenticação
                            </button>
                            <button onclick="showApiSection('pix')" class="api-nav-btn w-full text-left px-4 py-2 rounded-lg hover:bg-white/5 transition-colors">
                                <i class="fas fa-bolt mr-2"></i>PIX
                            </button>
                            <button onclick="showApiSection('cards')" class="api-nav-btn w-full text-left px-4 py-2 rounded-lg hover:bg-white/5 transition-colors">
                                <i class="fas fa-credit-card mr-2"></i>Cartões
                            </button>
                            <button onclick="showApiSection('webhooks')" class="api-nav-btn w-full text-left px-4 py-2 rounded-lg hover:bg-white/5 transition-colors">
                                <i class="fas fa-webhook mr-2"></i>Webhooks
                            </button>
                            <button onclick="showApiSection('sdks')" class="api-nav-btn w-full text-left px-4 py-2 rounded-lg hover:bg-white/5 transition-colors">
                                <i class="fas fa-code mr-2"></i>SDKs
                            </button> --}}
                        </nav>
                    </div>
                    
                    <div class="flex-1 p-6 overflow-y-auto">
                        <div id="quickstart" class="api-section">
                            <h3 class="text-xl font-bold mb-4">Quick Start</h3>
                            <p class="text-gray-400 mb-6">Comece a aceitar pagamentos em minutos com nossa API RESTful.</p>
                            
                            <div class="bg-dark rounded-xl p-4 mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400">Base URL</span>
                                    <button onclick="copyToClipboard('https://api.izuspay.com/v1')" class="text-primary hover:text-primary-dark transition-colors">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <code class="text-primary font-mono">https://api.izuspay.com/v1</code>
                            </div>
                            
                            <h4 class="text-lg font-semibold mb-3">Instalação</h4>
                            <div class="bg-dark rounded-xl p-4 mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400">npm</span>
                                    <button onclick="copyToClipboard('npm install izuspay-sdk')" class="text-primary hover:text-primary-dark transition-colors">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <code class="text-green-400 font-mono">npm install izuspay-sdk</code>
                            </div>
                        </div>
                        
                        <div id="authentication" class="api-section hidden">
                            <h3 class="text-xl font-bold mb-4">Autenticação</h3>
                            <p class="text-gray-400 mb-6">Use sua API Key no header Authorization de todas as requisições.</p>
                            
                            <div class="bg-dark rounded-xl p-4 mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400">Header</span>
                                    <button onclick="copyToClipboard('Authorization: Bearer sk_live_...')" class="text-primary hover:text-primary-dark transition-colors">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <code class="text-yellow-400 font-mono">Authorization: Bearer sk_live_...</code>
                            </div>
                            
                            <div class="bg-dark rounded-xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400">Exemplo cURL</span>
                                    <button onclick="copyToClipboard(`curl -X GET https://api.izuspay.com/v1/payments \\
  -H 'Authorization: Bearer sk_live_...' \\
  -H 'Content-Type: application/json'`)" class="text-primary hover:text-primary-dark transition-colors">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <pre class="text-gray-300 font-mono text-sm"><code>curl -X GET https://api.izuspay.com/v1/payments \
  -H 'Authorization: Bearer sk_live_...' \
  -H 'Content-Type: application/json'</code></pre>
                            </div>
                        </div>
                        
                        <div id="pix" class="api-section hidden">
                            <h3 class="text-xl font-bold mb-4">PIX</h3>
                            <p class="text-gray-400 mb-6">Crie cobranças PIX instantâneas com QR Code automático.</p>
                            
                            <h4 class="text-lg font-semibold mb-3">Criar Cobrança PIX</h4>
                            <div class="bg-dark rounded-xl p-4 mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400">POST /payments/pix</span>
                                    <button onclick="copyToClipboard(`{
  \"amount\": 10000,
  \"description\": \"Pagamento do pedido #123\",
  \"customer\": {
    \"name\": \"João Silva\",
    \"email\": \"joao@email.com\",
    \"document\": \"12345678901\"
  },
  \"expires_in\": 3600
}`)" class="text-primary hover:text-primary-dark transition-colors">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <pre class="text-gray-300 font-mono text-sm"><code>{
  "amount": 10000,
  "description": "Pagamento do pedido #123",
  "customer": {
    "name": "João Silva",
    "email": "joao@email.com",
    "document": "12345678901"
  },
  "expires_in": 3600
}</code></pre>
                            </div>
                            
                            <h4 class="text-lg font-semibold mb-3">Resposta</h4>
                            <div class="bg-dark rounded-xl p-4">
                                <pre class="text-gray-300 font-mono text-sm"><code>{
  "id": "pix_1234567890",
  "status": "pending",
  "amount": 10000,
  "qr_code": "00020126580014br.gov.bcb.pix...",
  "qr_code_url": "https://api.izuspay.com/qr/pix_1234567890.png",
  "expires_at": "2024-01-01T12:00:00Z"
}</code></pre>
                            </div>
                        </div>
                        
                        <div id="cards" class="api-section hidden">
                            <h3 class="text-xl font-bold mb-4">Cartões</h3>
                            <p class="text-gray-400 mb-6">Processe pagamentos com cartão de crédito e débito.</p>
                            
                            <h4 class="text-lg font-semibold mb-3">Criar Pagamento</h4>
                            <div class="bg-dark rounded-xl p-4 mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400">POST /payments/card</span>
                                    <button onclick="copyToClipboard(`{
  \"amount\": 10000,
  \"installments\": 1,
  \"card\": {
    \"number\": \"4111111111111111\",
    \"exp_month\": \"12\",
    \"exp_year\": \"2025\",
    \"cvc\": \"123\",
    \"holder_name\": \"JOAO SILVA\"
  },
  \"customer\": {
    \"name\": \"João Silva\",
    \"email\": \"joao@email.com\",
    \"document\": \"12345678901\"
  }
}`)" class="text-primary hover:text-primary-dark transition-colors">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <pre class="text-gray-300 font-mono text-sm"><code>{
  "amount": 10000,
  "installments": 1,
  "card": {
    "number": "4111111111111111",
    "exp_month": "12",
    "exp_year": "2025",
    "cvc": "123",
    "holder_name": "JOAO SILVA"
  },
  "customer": {
    "name": "João Silva",
    "email": "joao@email.com",
    "document": "12345678901"
  }
}</code></pre>
                            </div>
                        </div>
                        
                        <div id="webhooks" class="api-section hidden">
                            <h3 class="text-xl font-bold mb-4">Webhooks</h3>
                            <p class="text-gray-400 mb-6">Receba notificações em tempo real sobre mudanças de status.</p>
                            
                            <h4 class="text-lg font-semibold mb-3">Configurar Webhook</h4>
                            <div class="bg-dark rounded-xl p-4 mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400">POST /webhooks</span>
                                    <button onclick="copyToClipboard(`{
  \"url\": \"https://meusite.com/webhook\",
  \"events\": [\"payment.paid\", \"payment.failed\"]
}`)" class="text-primary hover:text-primary-dark transition-colors">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <pre class="text-gray-300 font-mono text-sm"><code>{
  "url": "https://meusite.com/webhook",
  "events": ["payment.paid", "payment.failed"]
}</code></pre>
                            </div>
                            
                            <h4 class="text-lg font-semibold mb-3">Payload do Webhook</h4>
                            <div class="bg-dark rounded-xl p-4">
                                <pre class="text-gray-300 font-mono text-sm"><code>{
  "event": "payment.paid",
  "data": {
    "id": "pay_1234567890",
    "status": "paid",
    "amount": 10000,
    "paid_at": "2024-01-01T12:00:00Z"
  }
}</code></pre>
                            </div>
                        </div>
                        
                        <div id="sdks" class="api-section hidden">
                            <h3 class="text-xl font-bold mb-4">SDKs</h3>
                            <p class="text-gray-400 mb-6">Bibliotecas oficiais para as principais linguagens.</p>
                            
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-dark rounded-xl p-4">
                                    <h4 class="font-semibold mb-2">Node.js</h4>
                                    <code class="text-green-400 font-mono text-sm">npm install izuspay-node</code>
                                </div>
                                <div class="bg-dark rounded-xl p-4">
                                    <h4 class="font-semibold mb-2">PHP</h4>
                                    <code class="text-blue-400 font-mono text-sm">composer require izuspay/php</code>
                                </div>
                                <div class="bg-dark rounded-xl p-4">
                                    <h4 class="font-semibold mb-2">Python</h4>
                                    <code class="text-yellow-400 font-mono text-sm">pip install izuspay</code>
                                </div>
                                <div class="bg-dark rounded-xl p-4">
                                    <h4 class="font-semibold mb-2">Ruby</h4>
                                    <code class="text-red-400 font-mono text-sm">gem install izuspay</code>
                                </div>
                            </div>
                            
                            <h4 class="text-lg font-semibold mb-3">Exemplo Node.js</h4>
                            <div class="bg-dark rounded-xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400">JavaScript</span>
                                    <button onclick="copyToClipboard(`const IzusPay = require('izuspay-node');
const client = new IzusPay('sk_live_...');

const payment = await client.payments.create({
  amount: 10000,
  method: 'pix',
  customer: {
    name: 'João Silva',
    email: 'joao@email.com'
  }
});`)" class="text-primary hover:text-primary-dark transition-colors">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <pre class="text-gray-300 font-mono text-sm"><code>const IzusPay = require('izuspay-node');
const client = new IzusPay('sk_live_...');

const payment = await client.payments.create({
  amount: 10000,
  method: 'pix',
  customer: {
    name: 'João Silva',
    email: 'joao@email.com'
  }
});</code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="calculatorModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-dark-light border border-white/20 rounded-2xl max-w-2xl w-full">
                <div class="flex items-center justify-between p-6 border-b border-white/10">
                    <h2 class="text-2xl font-bold">Calculadora de Economia</h2>
                    <button onclick="closeCalculator()" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Volume Mensal (R$)</label>
                            <input type="number" id="monthlyVolume" placeholder="100000" class="w-full bg-dark border border-white/20 rounded-lg px-4 py-3 focus:border-primary focus:outline-none" oninput="calculateSavings()">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Taxa Atual (%)</label>
                            <input type="number" id="currentRate" placeholder="3.5" step="0.1" class="w-full bg-dark border border-white/20 rounded-lg px-4 py-3 focus:border-primary focus:outline-none" oninput="calculateSavings()">
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-primary/10 to-secondary/10 border border-primary/20 rounded-xl p-6 mb-6">
                        <h3 class="text-xl font-bold mb-4">Economia com Izus Pay</h3>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div>
                                <div class="text-2xl font-bold text-primary" id="monthlySavings">R$ 0</div>
                                <div class="text-sm text-gray-400">Por mês</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-secondary" id="yearlySavings">R$ 0</div>
                                <div class="text-sm text-gray-400">Por ano</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-accent" id="savingsPercentage">0%</div>
                                <div class="text-sm text-gray-400">Economia</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button onclick="openApiModal(); closeCalculator();" class="bg-primary hover:bg-primary-dark px-8 py-3 rounded-xl font-semibold transition-all duration-300">
                            Começar Agora
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Counter Animation
        function animateCounters() {
            const counters = document.querySelectorAll('[data-counter]');
            counters.forEach(counter => {
                const target = parseFloat(counter.getAttribute('data-counter'));
                const increment = target / 100;
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    
                    if (target === 99.9) {
                        counter.textContent = current.toFixed(1);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 20);
            });
        }

        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.querySelector('[data-counter]')) {
                        animateCounters();
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const statsSection = document.querySelector('[data-counter]')?.closest('section');
            if (statsSection) {
                observer.observe(statsSection);
            }
        });

        // API Modal Functions
        function openApiModal() {
            document.getElementById('apiModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            showApiSection('quickstart');
        }

        function closeApiModal() {
            document.getElementById('apiModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function showApiSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.api-section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Remove active class from all nav buttons
            document.querySelectorAll('.api-nav-btn').forEach(btn => {
                btn.classList.remove('bg-primary/20', 'text-primary');
            });
            
            // Show selected section
            document.getElementById(sectionId).classList.remove('hidden');
            
            // Add active class to clicked button
            event.target.classList.add('bg-primary/20', 'text-primary');
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Show feedback
                const button = event.target;
                const originalIcon = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.classList.add('text-green-400');
                
                setTimeout(() => {
                    button.innerHTML = originalIcon;
                    button.classList.remove('text-green-400');
                    button.classList.add('text-primary');
                }, 1000);
            });
        }

        // Calculator Functions
        function openCalculator() {
            document.getElementById('calculatorModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeCalculator() {
            document.getElementById('calculatorModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function calculateSavings() {
            const volume = parseFloat(document.getElementById('monthlyVolume').value) || 0;
            const currentRate = parseFloat(document.getElementById('currentRate').value) || 0;
            const izusRate = 2.4; // Izus Pay rate
            
            const currentCost = volume * (currentRate / 100);
            const izusCost = volume * (izusRate / 100);
            const monthlySavings = currentCost - izusCost;
            const yearlySavings = monthlySavings * 12;
            const savingsPercentage = currentRate > 0 ? ((monthlySavings / currentCost) * 100) : 0;
            
            document.getElementById('monthlySavings').textContent = `R$ ${monthlySavings.toLocaleString('pt-BR', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
            document.getElementById('yearlySavings').textContent = `R$ ${yearlySavings.toLocaleString('pt-BR', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
            document.getElementById('savingsPercentage').textContent = `${savingsPercentage.toFixed(1)}%`;
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Close modals on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeApiModal();
                closeCalculator();
            }
        });

        // Close modals on backdrop click
        document.getElementById('apiModal').addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                closeApiModal();
            }
        });

        document.getElementById('calculatorModal').addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                closeCalculator();
            }
        });
    </script>
</body>
</html>