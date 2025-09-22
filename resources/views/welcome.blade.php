<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izus Payment - Gateway de Pagamentos Seguro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'izus-blue': '#1e40af',
                        'izus-dark': '#1e3a8a',
                        'izus-light': '#3b82f6',
                        'izus-accent': '#06b6d4'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50 border-b border-gray-100">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-izus-blue to-izus-accent rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-izus-blue to-izus-dark bg-clip-text text-transparent">
                            Izus Payment
                        </h1>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#recursos" class="text-gray-600 hover:text-izus-blue font-medium transition-colors">Recursos</a>
                    <a href="#seguranca" class="text-gray-600 hover:text-izus-blue font-medium transition-colors">Segurança</a>
                    <a href="#precos" class="text-gray-600 hover:text-izus-blue font-medium transition-colors">Preços</a>
                    <a href="#contato" class="text-gray-600 hover:text-izus-blue font-medium transition-colors">Contato</a>
                </div>
                
                <div class="flex items-center space-x-4">
    {{-- Botão de Login --}}
    <a href="{{ route('login') }}" 
       class="text-izus-blue hover:text-izus-dark font-medium transition-colors">
        Login
    </a>

    {{-- Botão de Cadastro --}}
    <a href="{{ route('association.register.form') }}" 
       class="bg-gradient-to-r from-izus-blue to-izus-dark text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
        Começar Agora
    </a>
</div>

            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-izus-blue via-izus-dark to-blue-900 text-white overflow-hidden" style="background-image: url('https://i.ibb.co/fVsPcTJH/Chat-GPT-Image-18-de-set-de-2025-02-07-45.png');">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-32 h-32 bg-izus-accent opacity-20 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-20 right-20 w-48 h-48 bg-blue-400 opacity-20 rounded-full blur-3xl animate-float" style="animation-delay: -1s;"></div>
        </div>
        
<div class="container mx-auto px-6 py-20 relative z-10 bg-cover bg-center" >
    <!-- Conteúdo -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-4 py-2 text-sm">
                        <i class="fas fa-shield-check text-green-300 mr-2"></i>
                        Certificação PCI DSS Nível 1
                    </div>
                    
                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                        Gateway de Pagamentos
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-cyan-300">
                            Seguro e Confiável
                        </span>
                    </h1>
                    
                    <p class="text-xl text-blue-100 max-w-xl leading-relaxed">
                        Processe pagamentos PIX, cartões e boletos com a máxima segurança. 
                        API robusta, taxas competitivas e suporte especializado para sua empresa.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-white text-izus-blue px-8 py-4 rounded-lg font-bold text-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-rocket mr-2"></i>
                            Integrar Agora
                        </button>
                        <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-izus-blue transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-play mr-2"></i>
                            Ver Demonstração
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-8 pt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold">99.9%</div>
                            <div class="text-blue-200 text-sm">Uptime</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">&lt;2s</div>
                            <div class="text-blue-200 text-sm">Latência</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">24/7</div>
                            <div class="text-blue-200 text-sm">Suporte</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-2xl p-8 border border-white border-opacity-20">
                        <div class="space-y-6">
                            <div class="flex items-center justify-between p-4 bg-white bg-opacity-20 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-qrcode text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold">PIX Instantâneo</div>
                                        <div class="text-blue-200 text-sm">R$ 1.250,00</div>
                                    </div>
                                </div>
                                <div class="text-green-300 font-bold">Aprovado</div>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-white bg-opacity-20 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-credit-card text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Cartão de Crédito</div>
                                        <div class="text-blue-200 text-sm">R$ 890,50</div>
                                    </div>
                                </div>
                                <div class="text-green-300 font-bold">Processando</div>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-white bg-opacity-20 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-barcode text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Boleto Bancário</div>
                                        <div class="text-blue-200 text-sm">R$ 2.100,00</div>
                                    </div>
                                </div>
                                <div class="text-yellow-300 font-bold">Pendente</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="recursos" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold mb-4 bg-gradient-to-r from-izus-blue to-izus-dark bg-clip-text text-transparent">
                    Recursos Empresariais
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Tecnologia bancária de ponta para processar seus pagamentos com máxima eficiência e segurança
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="group bg-gradient-to-br from-gray-50 to-blue-50 p-8 rounded-2xl hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-izus-blue to-izus-accent rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-bolt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">PIX Instantâneo</h3>
                    <p class="text-gray-600 mb-4">
                        Processamento PIX em tempo real com confirmação instantânea. 
                        Receba pagamentos 24/7 com máxima agilidade.
                    </p>
                </div>
                
                <div class="group bg-gradient-to-br from-gray-50 to-blue-50 p-8 rounded-2xl hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-izus-blue to-izus-accent rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Segurança Bancária</h3>
                    <p class="text-gray-600 mb-4">
                        Criptografia AES 256-bit, tokenização de dados e certificação PCI DSS. 
                        Seus dados e dos seus clientes sempre protegidos.
                    </p>
                    <div class="flex items-center text-izus-blue font-semibold">
                        <span>Conformidade 100%</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-gray-50 to-blue-50 p-8 rounded-2xl hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-izus-blue to-izus-accent rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-code text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">API Robusta</h3>
                    <p class="text-gray-600 mb-4">
                        RESTful API com documentação completa e SDKs para todas as linguagens. 
                        Integração simples em minutos.
                    </p>
                    <div class="flex items-center text-izus-blue font-semibold">
                        <span>Documentação completa</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section id="seguranca" class="py-20 bg-gradient-to-br from-gray-900 to-izus-dark text-white">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                        Segurança de
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-cyan-300">
                            Nível Bancário
                        </span>
                    </h2>
                    <p class="text-xl text-gray-300 mb-8">
                        Utilizamos os mais altos padrões de segurança da indústria financeira 
                        para proteger cada transação e dado sensível.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-lock text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Criptografia AES 256-bit</h3>
                                <p class="text-gray-300">Mesmo padrão usado por bancos centrais e instituições militares</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-certificate text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Certificação PCI DSS</h3>
                                <p class="text-gray-300">Nível 1 - O mais alto padrão de segurança para pagamentos</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-eye text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Monitoramento 24/7</h3>
                                <p class="text-gray-300">Detecção em tempo real de atividades suspeitas</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-900 to-purple-900 rounded-2xl p-8 border border-blue-500 border-opacity-30">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold mb-4">Status de Segurança</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-black bg-opacity-30 rounded-lg">
                                <span class="flex items-center">
                                    <i class="fas fa-shield-check text-green-400 mr-3"></i>
                                    Firewall Ativo
                                </span>
                                <span class="text-green-400 font-bold">ATIVO</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-black bg-opacity-30 rounded-lg">
                                <span class="flex items-center">
                                    <i class="fas fa-key text-blue-400 mr-3"></i>
                                    SSL/TLS Certificado
                                </span>
                                <span class="text-green-400 font-bold">VÁLIDO</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-black bg-opacity-30 rounded-lg">
                                <span class="flex items-center">
                                    <i class="fas fa-database text-purple-400 mr-3"></i>
                                    Backup Automático
                                </span>
                                <span class="text-green-400 font-bold">ATIVO</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-black bg-opacity-30 rounded-lg">
                                <span class="flex items-center">
                                    <i class="fas fa-user-shield text-cyan-400 mr-3"></i>
                                    Auditoria de Acesso
                                </span>
                                <span class="text-green-400 font-bold">ATIVO</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="precos" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold mb-4 bg-gradient-to-r from-izus-blue to-izus-dark bg-clip-text text-transparent">
                    Taxas Transparentes
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Preços justos e competitivos. Sem surpresas, sem taxas ocultas.
                </p>
            </div>
            
    <div class="flex justify-center items-center h-full my-auto">
    <div class="bg-white rounded-2xl p-8 shadow-xl border-2 border-izus-blue relative max-w-sm w-full mx-4">
        <div class="text-center mb-8">
            <h3 class="text-3xl font-bold mb-2 text-izus-blue">PIX, Cartão e Boleto</h3>
            <p class="text-gray-600 text-lg">Seu negócio no controle, com taxas diferenciadas e saques rápidos!</p>
        </div>
        
        <div class="space-y-6 mb-8 text-center">
            <div class="flex items-center justify-between">
                <span class="text-lg font-medium">Saque PIX:</span>
                <span class="text-lg font-bold text-izus-blue">D+0</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-lg font-medium">Saque Cartão:</span>
                <span class="text-lg font-bold text-izus-blue">D+1</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-lg font-medium">Saque Boleto:</span>
                <span class="text-lg font-bold text-izus-blue">D+1</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-lg font-medium">Taxa:</span>
                <span class="text-lg font-bold text-izus-blue">Diferenciada por transação</span>
            </div>
        </div>
        
        <div class="flex flex-col space-y-4">
            <a href="#" class="w-full bg-gradient-to-r from-izus-blue to-izus-dark text-white py-3 rounded-lg font-semibold text-center hover:shadow-lg transition-all duration-200">
                Fazer Cadastro
            </a>
            <a href="https://api.whatsapp.com/send?phone=SEU_NUMERO_DE_WHATSAPP&text=Ol%C3%A1%2C%20gostaria%20de%20falar%20com%20o%20suporte." target="_blank" class="w-full bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold text-center hover:bg-gray-300 transition-all duration-200">
                Falar com Suporte
            </a>
        </div>
    </div>
</div>
            
          
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-izus-blue to-izus-dark text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                Pronto para Começar?
            </h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
                Integre nossa API em minutos e comece a processar pagamentos com a segurança 
                e confiabilidade que sua empresa merece.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button class="bg-white text-izus-blue px-8 py-4 rounded-lg font-bold text-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                    Criar Conta Gratuita
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-izus-blue transition-all duration-200">
                    Ver Documentação
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-izus-blue to-izus-accent rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-izus-blue to-izus-accent bg-clip-text text-transparent">
                            Izus Payment
                        </h3>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Gateway de pagamentos seguro e confiável para empresas que buscam excelência.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-izus-accent transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-izus-accent transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-izus-accent transition-colors">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4 text-white">Produtos</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">API de Pagamentos</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">PIX Instantâneo</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Checkout Seguro</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">SDK Mobile</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4 text-white">Desenvolvedores</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Documentação</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Referência da API</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">SDKs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Status da API</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4 text-white">Suporte</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Central de Ajuda</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contato</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">WhatsApp</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Políticas</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">&copy; 2024 Izus Payment. Todos os direitos reservados.</p>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <i class="fas fa-shield-check text-green-500"></i>
                        <span>PCI DSS Certificado</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <i class="fas fa-lock text-blue-400"></i>
                        <span>SSL Seguro</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <i class="fas fa-chart-line text-green-500"></i>
                        <span>99.9% Uptime</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
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

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('section > div').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Add mobile menu button functionality
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('header nav');
            if (window.innerWidth < 768) {
                const mobileButton = document.createElement('button');
                mobileButton.innerHTML = '<i class="fas fa-bars"></i>';
                mobileButton.className = 'md:hidden text-izus-blue text-xl';
                mobileButton.onclick = toggleMobileMenu;
                header.querySelector('div').appendChild(mobileButton);
            }
        });
    </script>
</body>
</html>