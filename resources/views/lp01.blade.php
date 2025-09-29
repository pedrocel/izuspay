<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izus Pay - Gateway de Pagamentos e Api pix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#2563eb',
                        'primary-light': '#3b82f6',
                        'primary-dark': '#1d4ed8',
                        'gray-50': '#f9fafb',
                        'gray-100': '#f3f4f6',
                        'gray-200': '#e5e7eb',
                        'gray-300': '#d1d5db',
                        'gray-400': '#9ca3af',
                        'gray-500': '#6b7280',
                        'gray-600': '#4b5563',
                        'gray-700': '#374151',
                        'gray-800': '#1f2937',
                        'gray-900': '#111827',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-900 font-inter antialiased">
     Navigation 
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <div class="text-xl font-semibold text-gray-900">
                        Izus Pay
                    </div>
                    <div class="hidden md:flex space-x-6">
                        <a href="#" class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors">Documentação</a>
                        <a href="#" class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors">Suporte</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors">Login</a>
                    <a href="#" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        Começar
                    </a>
                </div>
            </div>
        </div>
    </nav>

     Hero Section 
    <section class="pt-24 pb-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="mb-6">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary border border-primary/20">
                    ✨ Nova API v2 disponível
                </span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Receba seus pagamentos
                <br>
                <span class="text-primary">em segundos</span>
            </h1>
            
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                A plataforma de pagamentos mais simples do Brasil. PIX instantâneo, cartões sem complicação e APIs que funcionam.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                <a href="#" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Criar conta grátis
                </a>
                <a href="#" class="text-gray-600 hover:text-gray-900 px-6 py-3 font-medium transition-colors flex items-center">
                    Ver demonstração
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m6-10V7a3 3 0 00-3-3H6a3 3 0 00-3 3v1"></path>
                    </svg>
                </a>
            </div>
            
             Trust indicators 
            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 text-sm text-gray-500">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Integração em 5 minutos
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Sem taxa de setup
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Suporte 24/7
                </div>
            </div>
        </div>
    </section>

     Stats Section 
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold text-gray-900 mb-2">50k+</div>
                    <div class="text-gray-600 text-sm">Transações/dia</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900 mb-2">99.9%</div>
                    <div class="text-gray-600 text-sm">Uptime</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900 mb-2">2k+</div>
                    <div class="text-gray-600 text-sm">Empresas</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900 mb-2">R$ 2bi</div>
                    <div class="text-gray-600 text-sm">Processados</div>
                </div>
            </div>
        </div>
    </section>

     Features Section 
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Tudo que você precisa para receber pagamentos
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    APIs simples, documentação clara e suporte excepcional
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">PIX Instantâneo</h3>
                    <p class="text-gray-600">Receba pagamentos PIX em tempo real com QR Code automático e notificações instantâneas.</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Cartões Globais</h3>
                    <p class="text-gray-600">Aceite cartões de crédito e débito de qualquer lugar do mundo com as menores taxas.</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">APIs Robustas</h3>
                    <p class="text-gray-600">Documentação completa, SDKs oficiais e webhooks confiáveis para sua integração.</p>
                </div>
            </div>
        </div>
    </section>

     Code Example Section 
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">
                        Integração em minutos, não em dias
                    </h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Nossa API foi projetada para ser simples e intuitiva. Comece a receber pagamentos com apenas algumas linhas de código.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Documentação completa e exemplos práticos
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            SDKs oficiais para todas as linguagens
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Ambiente de testes gratuito
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-gray-500">Criar pagamento PIX</span>
                        <button class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                    <pre class="text-sm text-gray-800 overflow-x-auto"><code>const payment = await izuspay.payments.create({
  amount: 10000, // R$ 100,00
  method: 'pix',
  customer: {
    name: 'João Silva',
    email: 'joao@email.com'
  }
});

console.log(payment.qr_code_url);</code></pre>
                </div>
            </div>
        </div>
    </section>

     Testimonials 
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Empresas que confiam no Izus Pay
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gray-100 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-900">Carlos Silva</div>
                            <div class="text-sm text-gray-500">CEO, TechStart</div>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "Migrar para o Izus Pay foi a melhor decisão. Reduzimos custos em 40% e a integração foi super simples."
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gray-100 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-900">Ana Costa</div>
                            <div class="text-sm text-gray-500">CTO, E-commerce Plus</div>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "A documentação é excelente e o suporte responde em minutos. Nossa conversão aumentou 25%."
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gray-100 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-900">Pedro Santos</div>
                            <div class="text-sm text-gray-500">Founder, FoodApp</div>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "PIX instantâneo mudou nosso negócio. Recebemos pagamentos em segundos, não em dias."
                    </p>
                </div>
            </div>
        </div>
    </section>

     CTA Section 
    <section class="py-20 bg-primary">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Pronto para começar?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Junte-se a milhares de empresas que já escolheram o Izus Pay. Comece gratuitamente hoje mesmo.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#" class="bg-white text-primary hover:bg-gray-50 px-8 py-3 rounded-lg font-medium transition-colors">
                    Criar conta grátis
                </a>
                <a href="#" class="text-white hover:text-blue-100 px-8 py-3 font-medium transition-colors flex items-center">
                    Falar com especialista
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

     Footer 
    <footer class="bg-white border-t border-gray-200 py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="text-xl font-semibold text-gray-900 mb-4">Izus Pay</div>
                    <p class="text-gray-600 text-sm mb-4">
                        O gateway de pagamentos mais simples do Brasil.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-medium text-gray-900 mb-4">Produto</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">Recursos</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">Preços</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">Integrações</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-medium text-gray-900 mb-4">Desenvolvedores</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">Documentação</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">API Reference</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">SDKs</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-medium text-gray-900 mb-4">Empresa</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">Sobre</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">Contato</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-500 text-sm mb-4 md:mb-0">
                    © 2025 Izus Pay. Todos os direitos reservados.
                </div>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors">Privacidade</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors">Termos</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>