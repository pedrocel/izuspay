<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoPago - Gateway de Pagamentos Premium</title>
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
                        WoPago
                    </div>
                    <div class="hidden md:flex space-x-8">
                        <a href="#docs" class="text-gray-300 hover:text-white transition-colors">Documentação</a>
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

    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary/20 via-transparent to-secondary/20"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(0,102,255,0.1),transparent_50%)]"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="animate-fade-in">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black mb-8 leading-tight">
                    <span class="bg-gradient-to-r from-white via-primary to-secondary bg-clip-text text-transparent">
                        Pagamentos
                    </span>
                    <br>
                    <span class="text-white">do Futuro</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                    A plataforma de pagamentos mais avançada do Brasil. PIX instantâneo, cartões globais, 
                    APIs robustas e segurança bancária.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="#register" class="bg-primary hover:bg-primary-dark px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-primary/25">
                        Começar Agora
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute top-20 left-10 w-20 h-20 bg-primary/20 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-secondary/20 rounded-full animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute top-1/2 left-20 w-16 h-16 bg-accent/20 rounded-full animate-float" style="animation-delay: -4s;"></div>
    </section>

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
                    <h3 class="text-2xl font-bold mb-4">Agente de contas</h3>
                    <p class="text-gray-400">Agente personalizado para seu negócio.</p>
                </div>
            </div>

            <div class="text-center">
                <div class="inline-flex space-x-4">
                    <button class="bg-primary hover:bg-primary-dark px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-comments mr-2"></i>
                        Iniciar Chat
                    </button>
                    <a href="#docs" class="border border-white/20 hover:border-primary px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
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
                Junte-se a milhares de empresas que já escolheram o WoPago. 
                Comece gratuitamente e veja a diferença em minutos.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="#register" class="bg-primary hover:bg-primary-dark px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-primary/25">
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
                        WoPago
                    </div>
                    <p class="text-gray-400 mb-6">
                        O gateway de pagamentos mais avançado do Brasil. Segurança, velocidade e inovação em cada transação.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Produto</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Recursos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Preços</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Integrações</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">API</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Empresa</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Sobre</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Carreiras</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contato</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Suporte</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Central de Ajuda</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Documentação</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Status</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Comunidade</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © 2024 WoPago. Todos os direitos reservados.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Privacidade</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Termos</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Cookies</a>
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

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('[data-counter]');
            counters.forEach(counter => {
                const target = parseFloat(counter.getAttribute('data-counter'));
                const increment = target / 100;
                let current = 0;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
            });
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    if (entry.target.hasAttribute('data-counter')) {
                        animateCounters();
                    }
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.animate-scale-in, .animate-slide-up').forEach(el => {
            observer.observe(el);
        });

        // Modal functionality
        function openApiModal() {
            alert('Funcionalidade de modal será implementada em breve!');
        }
    </script>
</body>
</html>

