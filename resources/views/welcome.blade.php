<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Alterado título para Lux Secrets -->
    <title>Lux Secrets - Plataforma de Conteúdos Privados</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-purple': '#621d62',
                        'brand-magenta': '#ff00ff'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Cookie Banner -->
    <div id="cookieBanner" class="fixed bottom-0 left-0 right-0 bg-brand-purple text-white p-4 z-50 transform translate-y-full transition-transform duration-300">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm" data-translate="cookie-message">
                Utilizamos cookies para melhorar sua experiência. Ao continuar navegando, você concorda com nossa política de privacidade.
            </p>
            <div class="flex gap-2">
                <button onclick="acceptCookies()" class="bg-brand-magenta hover:bg-pink-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <span data-translate="accept">Aceitar</span>
                </button>
                <button onclick="showPrivacyModal()" class="border border-white hover:bg-white hover:text-brand-purple px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <span data-translate="privacy-policy">Política de Privacidade</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-40">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <!-- Adicionado espaço para logo e alterado nome para Lux Secrets -->
                <div class="flex items-center space-x-3">
                    <!-- Espaço reservado para logo -->
                    <div class="w-36  justify-center">
                        <img class="text-white text-xl" src="https://i.ibb.co/0pNpWH61/image-removebg-preview-1.png">
                    </div>
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Language Selector -->
                <select id="languageSelector" onchange="changeLanguage()" class="bg-gray-100 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-purple">
                    <option value="pt">🇧🇷 PT</option>
                    <option value="en">🇺🇸 EN</option>
                    <option value="es">🇪🇸 ES</option>
                </select>
                
                <!-- Libras Accessibility -->
                <button onclick="toggleLibras()" class="bg-brand-purple hover:bg-purple-800 text-white px-3 py-2 rounded-lg transition-colors" title="Acessibilidade em Libras">
                    <i class="fas fa-hands"></i>
                </button>
                
                <a href="{{ route('login') }}" class="bg-gradient-to-r from-brand-purple to-brand-magenta text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition-all">
                    <span data-translate="login">Entrar</span>
                </a>
            </div>
        </nav>
    </header>

    <!-- Libras Video (Hidden by default) -->
    <div id="librasVideo" class="fixed bottom-20 right-4 w-64 h-48 bg-black rounded-lg shadow-2xl z-50 hidden">
        <div class="flex items-center justify-between p-2 bg-brand-purple rounded-t-lg">
            <span class="text-white text-sm font-medium">Intérprete de Libras</span>
            <button onclick="toggleLibras()" class="text-white hover:text-gray-300">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4 text-center text-white">
            <i class="fas fa-video text-4xl mb-2"></i>
            <p class="text-sm">Intérprete disponível</p>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-brand-purple via-purple-700 to-brand-magenta text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                <span data-translate="hero-title">Monetize Seu Conteúdo</span>
                <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-pink-400">
                    <span data-translate="hero-subtitle">de Forma Exclusiva</span>
                </span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto opacity-90" data-translate="hero-description">
                A plataforma definitiva para criadores de conteúdo que desejam transformar sua paixão em renda recorrente através de assinaturas exclusivas.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button class="bg-white text-brand-purple px-8 py-4 rounded-xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all">
                    <span data-translate="start-now">Começar Agora</span>
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-brand-purple transition-all">
                    <span data-translate="watch-demo">Ver Demo</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <!-- Alterado título para mencionar Lux Secrets -->
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-brand-purple to-brand-magenta bg-clip-text text-transparent" data-translate="features-title">
                    Por que escolher a Lux Secrets?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto" data-translate="features-subtitle">
                    Oferecemos as melhores ferramentas para você criar, gerenciar e monetizar seu conteúdo exclusivo.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-gradient-to-r from-brand-purple to-brand-magenta rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-lock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" data-translate="feature1-title">Conteúdo Exclusivo</h3>
                    <p class="text-gray-600" data-translate="feature1-description">
                        Crie conteúdos privados e exclusivos para seus assinantes mais fiéis, aumentando o engajamento e a fidelização.
                    </p>
                </div>
                
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-gradient-to-r from-brand-purple to-brand-magenta rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" data-translate="feature2-title">Renda Recorrente</h3>
                    <p class="text-gray-600" data-translate="feature2-description">
                        Sistema de assinaturas mensais, trimestrais e anuais que garantem uma renda estável e previsível.
                    </p>
                </div>
                
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-gradient-to-r from-brand-purple to-brand-magenta rounded-2xl flex items-center justify-center mb-6">
                        <!-- Adicionado ícone de geolocalização -->
                        <i class="fas fa-globe-americas text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" data-translate="feature3-title">Liberdade Geográfica</h3>
                    <p class="text-gray-600" data-translate="feature3-description">
                        Trabalhe de qualquer lugar do mundo. Nossa plataforma permite que você monetize seu conteúdo independente da sua localização.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Nova seção de casos de sucesso -->
    <!-- Success Stories Section -->
    <section class="py-20 bg-gradient-to-br from-purple-50 to-pink-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-brand-purple to-brand-magenta bg-clip-text text-transparent" data-translate="success-title">
                    Casos de Sucesso
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto" data-translate="success-subtitle">
                    Conheça criadores que transformaram suas vidas com nossa plataforma
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-brand-purple to-brand-magenta rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" data-translate="creator1-name">Marina Silva</h3>
                            <p class="text-gray-600" data-translate="creator1-category">Fitness & Lifestyle</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="text-3xl font-bold text-brand-purple">R$ 45.000</span>
                        <span class="text-gray-600 ml-2" data-translate="monthly-revenue">/mês</span>
                    </div>
                    <p class="text-gray-600 mb-4" data-translate="creator1-story">
                        "Trabalho de Bali há 2 anos, criando conteúdo de fitness e bem-estar. A plataforma me permitiu ter liberdade geográfica total enquanto construo uma comunidade global de mais de 15.000 assinantes."
                    </p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span data-translate="creator1-location">Bali, Indonésia</span>
                    </div>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-brand-purple to-brand-magenta rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" data-translate="creator2-name">Carlos Rodriguez</h3>
                            <p class="text-gray-600" data-translate="creator2-category">Culinária & Gastronomia</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="text-3xl font-bold text-brand-purple">R$ 52.000</span>
                        <span class="text-gray-600 ml-2" data-translate="monthly-revenue">/mês</span>
                    </div>
                    <p class="text-gray-600 mb-4" data-translate="creator2-story">
                        "Viajo pelo mundo explorando culinárias locais e compartilho receitas exclusivas. Meus 8.500 assinantes pagam por conteúdo premium que só encontram aqui. A liberdade de trabalhar de qualquer cozinha do mundo é incrível!"
                    </p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span data-translate="creator2-location">Lisboa, Portugal</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nova seção de Prêmios de Bonificação -->
    <!-- Rewards Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-brand-purple to-brand-magenta bg-clip-text text-transparent" data-translate="rewards-title">
                    Prêmios de Bonificação
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto" data-translate="rewards-subtitle">
                    Alcance metas de faturamento e ganhe prêmios incríveis que vão transformar sua vida
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Viagem -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl hover:shadow-xl transition-all text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-brand-purple to-brand-magenta rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-plane text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" data-translate="reward-travel-title">Viagens Exclusivas</h3>
                    <p class="text-gray-600 mb-6" data-translate="reward-travel-desc">
                        Viagens all-inclusive para destinos paradisíacos ao atingir metas de faturamento mensal
                    </p>
                    <div class="bg-white p-4 rounded-xl">
                        <span class="text-brand-purple font-bold text-lg" data-translate="reward-travel-goal">Meta: R$ 1.000.000</span>
                    </div>
                </div>
                
                <!-- iPhone -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl hover:shadow-xl transition-all text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-brand-purple to-brand-magenta rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fab fa-apple text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" data-translate="reward-iphone-title">iPhone Pro Max + Macbook Pro</h3>
                    <p class="text-gray-600 mb-6" data-translate="reward-iphone-desc">
                        Receba o iPhone e o macbook mais recente ao alcançar marcos importantes de crescimento
                    </p>
                    <div class="bg-white p-4 rounded-xl">
                        <span class="text-brand-purple font-bold text-lg" data-translate="reward-iphone-goal">Meta: R$ 500.000</span>
                    </div>
                </div>
                
                <!-- MacBook -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl hover:shadow-xl transition-all text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-brand-purple to-brand-magenta rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-laptop text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" data-translate="reward-macbook-title">Ipad</h3>
                    <p class="text-gray-600 mb-6" data-translate="reward-macbook-desc">
                        Ipad para turbinar sua produção de conteúdo profissional
                    </p>
                    <div class="bg-white p-4 rounded-xl">
                        <span class="text-brand-purple font-bold text-lg" data-translate="reward-macbook-goal">Meta: R$ 100.000</span>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <p class="text-gray-600" data-translate="rewards-note">
                    * Prêmios entregues mediante comprovação de faturamento e permanência na plataforma por período mínimo
                </p>
            </div>
        </div>
    </section>

    <!-- Reformulação completa da seção de preços para mostrar taxa padrão da plataforma -->
    <!-- Platform Fees Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-brand-purple to-brand-magenta bg-clip-text text-transparent" data-translate="fees-title">
                    Taxas da Plataforma
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto" data-translate="fees-subtitle">
                    Transparência total nas nossas taxas. Você só paga quando fatura.
                </p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <!-- Taxa Principal -->
                <div class="bg-white p-8 rounded-2xl shadow-lg mb-8">
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-bold mb-4" data-translate="platform-fee-title">Taxa Padrão da Plataforma</h3>
                        <div class="text-6xl font-bold text-black mb-4" data-translate="platform-fee-rate">10%</div>
                        <p class="text-xl text-gray-600" data-translate="platform-fee-desc">sobre o valor bruto das assinaturas</p>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-xl font-bold mb-4 text-brand-purple" data-translate="included-title">Incluído na Taxa:</h4>
                            <ul class="space-y-3">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    <span data-translate="included-hosting">Hospedagem e infraestrutura</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    <span data-translate="included-security">Segurança e proteção de dados</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    <span data-translate="included-support">Suporte técnico 24/7</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    <span data-translate="included-analytics">Analytics e relatórios</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 class="text-xl font-bold mb-4 text-brand-purple" data-translate="payment-methods-title">Métodos de Pagamento:</h4>
                            <ul class="space-y-3">
                                <li class="flex items-center">
                                    <i class="fas fa-credit-card text-brand-magenta mr-3"></i>
                                    <span data-translate="payment-credit">Cartão de Crédito</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-mobile-alt text-brand-magenta mr-3"></i>
                                    <span data-translate="payment-pix">PIX (instantâneo)</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-university text-brand-magenta mr-3"></i>
                                    <span data-translate="payment-bank">Transferência bancária</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-wallet text-brand-magenta mr-3"></i>
                                    <span data-translate="payment-digital">Carteiras digitais</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Informações de Saque -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h4 class="text-xl font-bold mb-4 text-brand-purple" data-translate="withdrawal-title">Saques</h4>
                        <ul class="space-y-2 text-gray-600">
                            <li data-translate="withdrawal-frequency">• Saques diários disponíveis</li>
                            <li data-translate="withdrawal-minimum">• Valor mínimo: R$ 10</li>
                            <li data-translate="withdrawal-time">• Processamento em tempo real</li>
                            <li data-translate="withdrawal-fee">• Taxa de saque: R$ 2,50</li>
                        </ul>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h4 class="text-xl font-bold mb-4 text-brand-purple" data-translate="transactions-title">Transações</h4>
                        <ul class="space-y-2 text-gray-600">
                            <li data-translate="transaction-processing">• Processamento automático</li>
                            <li data-translate="transaction-security">• Criptografia de ponta a ponta</li>
                            <li data-translate="transaction-compliance">• Compliance PCI DSS</li>
                            <li data-translate="transaction-monitoring">• Monitoramento 24/7</li>
                        </ul>
                    </div>
                </div>
                
                <div class="text-center mt-8">
                    <button class="bg-black text-white px-12 py-4 rounded-xl font-bold text-xl hover:bg-gray-800 transition-all">
                        <span data-translate="start-earning">Começar a Faturar</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-brand-purple to-brand-magenta text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6" data-translate="cta-title">
                Pronto para Começar?
            </h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90" data-translate="cta-description">
                Junte-se a milhares de criadores que já estão monetizando seu conteúdo de forma inteligente e lucrativa.
            </p>
            <button class="bg-white text-brand-purple px-12 py-4 rounded-xl font-bold text-xl hover:shadow-2xl transform hover:scale-105 transition-all">
                <span data-translate="start-free">Começar Gratuitamente</span>
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <!-- Alterado nome no footer para Lux Secrets -->
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="flex items-center space-x-3">
                    <!-- Espaço reservado para logo -->
                    <div class="w-36  justify-center">
                        <img class="text-white text-xl" src="https://i.ibb.co/0pNpWH61/image-removebg-preview-1.png">
                    </div>
                </div>
                    </div>
                    <p class="text-gray-400" data-translate="footer-description">
                        A plataforma definitiva para criadores de conteúdo exclusivo.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4" data-translate="footer-product">Produto</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors" data-translate="footer-features">Recursos</a></li>
                        <li><a href="#" class="hover:text-white transition-colors" data-translate="footer-pricing">Preços</a></li>
                        <li><a href="#" class="hover:text-white transition-colors" data-translate="footer-security">Segurança</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4" data-translate="footer-support">Suporte</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors" data-translate="footer-help">Central de Ajuda</a></li>
                        <li><a href="#" class="hover:text-white transition-colors" data-translate="footer-contact">Contato</a></li>
                        <li><a href="#" onclick="showPrivacyModal()" class="hover:text-white transition-colors cursor-pointer" data-translate="privacy-policy">Política de Privacidade</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4" data-translate="footer-social">Redes Sociais</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <!-- Alterado copyright para Lux Secrets -->
                <p>&copy; 2024 Lux Secrets. <span data-translate="footer-rights">Todos os direitos reservados.</span></p>
            </div>
        </div>
    </footer>

    <!-- Privacy Policy Modal -->
    <div id="privacyModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold" data-translate="privacy-policy">Política de Privacidade</h2>
                    <button onclick="hidePrivacyModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="prose max-w-none">
                    <h3 data-translate="privacy-section1">1. Coleta de Informações</h3>
                    <p data-translate="privacy-content1">
                        Coletamos informações que você nos fornece diretamente, como quando você cria uma conta, publica conteúdo ou entra em contato conosco. Isso pode incluir seu nome, endereço de email, informações de pagamento e conteúdo que você escolhe compartilhar.
                    </p>
                    
                    <h3 data-translate="privacy-section2">2. Uso das Informações</h3>
                    <p data-translate="privacy-content2">
                        Utilizamos suas informações para fornecer, manter e melhorar nossos serviços, processar transações, enviar comunicações relacionadas ao serviço e personalizar sua experiência na plataforma.
                    </p>
                    
                    <h3 data-translate="privacy-section3">3. Compartilhamento de Informações</h3>
                    <p data-translate="privacy-content3">
                        Não vendemos, alugamos ou compartilhamos suas informações pessoais com terceiros para fins comerciais, exceto conforme descrito nesta política ou com seu consentimento explícito.
                    </p>
                    
                    <h3 data-translate="privacy-section4">4. Cookies e Tecnologias Similares</h3>
                    <p data-translate="privacy-content4">
                        Utilizamos cookies e tecnologias similares para melhorar sua experiência, analisar o uso do site e personalizar conteúdo. Você pode controlar o uso de cookies através das configurações do seu navegador.
                    </p>
                    
                    <h3 data-translate="privacy-section5">5. Segurança</h3>
                    <p data-translate="privacy-content5">
                        Implementamos medidas de segurança técnicas e organizacionais apropriadas para proteger suas informações pessoais contra acesso não autorizado, alteração, divulgação ou destruição.
                    </p>
                    
                    <h3 data-translate="privacy-section6">6. Seus Direitos</h3>
                    <p data-translate="privacy-content6">
                        Você tem o direito de acessar, atualizar, corrigir ou excluir suas informações pessoais. Também pode optar por não receber certas comunicações de marketing de nossa parte.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Translations
        const translations = {
            pt: {
                'cookie-message': 'Utilizamos cookies para melhorar sua experiência. Ao continuar navegando, você concorda com nossa política de privacidade.',
                'accept': 'Aceitar',
                'privacy-policy': 'Política de Privacidade',
                'login': 'Entrar',
                'hero-title': 'Monetize Seu Conteúdo',
                'hero-subtitle': 'de Forma Exclusiva',
                'hero-description': 'A plataforma definitiva para criadores de conteúdo que desejam transformar sua paixão em renda recorrente através de assinaturas exclusivas.',
                'start-now': 'Começar Agora',
                'watch-demo': 'Ver Demo',
                <!-- Atualizadas traduções para Lux Secrets -->
                'features-title': 'Por que escolher a Lux Secrets?',
                'features-subtitle': 'Oferecemos as melhores ferramentas para você criar, gerenciar e monetizar seu conteúdo exclusivo.',
                'feature1-title': 'Conteúdo Exclusivo',
                'feature1-description': 'Crie conteúdos privados e exclusivos para seus assinantes mais fiéis, aumentando o engajamento e a fidelização.',
                'feature2-title': 'Renda Recorrente',
                'feature2-description': 'Sistema de assinaturas mensais, trimestrais e anuais que garantem uma renda estável e previsível.',
                'feature3-title': 'Liberdade Geográfica',
                'feature3-description': 'Trabalhe de qualquer lugar do mundo. Nossa plataforma permite que você monetize seu conteúdo independente da sua localização.',
                'success-title': 'Casos de Sucesso',
                'success-subtitle': 'Conheça criadores que transformaram suas vidas com nossa plataforma',
                'creator1-name': 'Marina Silva',
                'creator1-category': 'Fitness & Lifestyle',
                'creator1-story': '"Trabalho de Bali há 2 anos, criando conteúdo de fitness e bem-estar. A plataforma me permitiu ter liberdade geográfica total enquanto construo uma comunidade global de mais de 15.000 assinantes."',
                'creator1-location': 'Bali, Indonésia',
                'creator2-name': 'Carlos Rodriguez',
                'creator2-category': 'Culinária & Gastronomia',
                'creator2-story': '"Viajo pelo mundo explorando culinárias locais e compartilho receitas exclusivas. Meus 8.500 assinantes pagam por conteúdo premium que só encontram aqui. A liberdade de trabalhar de qualquer cozinha do mundo é incrível!"',
                'creator2-location': 'Lisboa, Portugal',
                'monthly-revenue': '/mês',
                'custom-rates': 'Taxas Personalizadas',
                'pricing-subtitle': 'Escolha o plano ideal para o seu negócio. Taxas personalizadas baseadas no seu volume e necessidades.',
                'plan-starter-desc': 'Baseado no seu volume',
                'plan-pro-desc': 'Baseado no seu volume',
                'plan-enterprise-desc': 'Baseado no seu volume',
                'pricing-note': '* Nossas taxas são personalizadas baseadas no seu volume de transações e necessidades específicas.',
                'pricing-details': 'Sem taxas de setup, sem mensalidades fixas. Entre em contato para conhecer sua taxa personalizada.',
                'cta-title': 'Pronto para Começar?',
                'cta-description': 'Junte-se a milhares de criadores que já estão monetizando seu conteúdo de forma inteligente e lucrativa.',
                'start-free': 'Começar Gratuitamente',
                <!-- Atualizadas traduções para Lux Secrets -->
                'footer-description': 'A plataforma definitiva para criadores de conteúdo exclusivo.',
                'footer-product': 'Produto',
                'footer-features': 'Recursos',
                'footer-pricing': 'Preços',
                'footer-security': 'Segurança',
                'footer-support': 'Suporte',
                'footer-help': 'Central de Ajuda',
                'footer-contact': 'Contato',
                'footer-social': 'Redes Sociais',
                'footer-rights': 'Todos os direitos reservados.',
                'privacy-section1': '1. Coleta de Informações',
                'privacy-content1': 'Coletamos informações que você nos fornece diretamente, como quando você cria uma conta, publica conteúdo ou entra em contato conosco. Isso pode incluir seu nome, endereço de email, informações de pagamento e conteúdo que você escolhe compartilhar.',
                'privacy-section2': '2. Uso das Informações',
                'privacy-content2': 'Utilizamos suas informações para fornecer, manter e melhorar nossos serviços, processar transações, enviar comunicações relacionadas ao serviço e personalizar sua experiência na plataforma.',
                'privacy-section3': '3. Compartilhamento de Informações',
                'privacy-content3': 'Não vendemos, alugamos ou compartilhamos suas informações pessoais com terceiros para fins comerciais, exceto conforme descrito nesta política ou com seu consentimento explícito.',
                'privacy-section4': '4. Cookies e Tecnologias Similares',
                'privacy-content4': 'Utilizamos cookies e tecnologias similares para melhorar sua experiência, analisar o uso do site e personalizar conteúdo. Você pode controlar o uso de cookies através das configurações do seu navegador.',
                'privacy-section5': '5. Segurança',
                'privacy-content5': 'Implementamos medidas de segurança técnicas e organizacionais apropriadas para proteger suas informações pessoais contra acesso não autorizado, alteração, divulgação ou destruição.',
                'privacy-section6': '6. Seus Direitos',
                'privacy-content6': 'Você tem o direito de acessar, atualizar, corrigir ou excluir suas informações pessoais. Também pode optar por não receber certas comunicações de marketing de nossa parte.'
            },
            en: {
                'cookie-message': 'We use cookies to improve your experience. By continuing to browse, you agree to our privacy policy.',
                'accept': 'Accept',
                'privacy-policy': 'Privacy Policy',
                'login': 'Login',
                'hero-title': 'Monetize Your Content',
                'hero-subtitle': 'Exclusively',
                'hero-description': 'The ultimate platform for content creators who want to turn their passion into recurring income through exclusive subscriptions.',
                'start-now': 'Start Now',
                'watch-demo': 'Watch Demo',
                <!-- Atualizadas traduções para Lux Secrets -->
                'features-title': 'Why choose Lux Secrets?',
                'features-subtitle': 'We offer the best tools for you to create, manage and monetize your exclusive content.',
                'feature1-title': 'Exclusive Content',
                'feature1-description': 'Create private and exclusive content for your most loyal subscribers, increasing engagement and loyalty.',
                'feature2-title': 'Recurring Revenue',
                'feature2-description': 'Monthly, quarterly and annual subscription system that guarantees stable and predictable income.',
                'feature3-title': 'Geographic Freedom',
                'feature3-description': 'Work from anywhere in the world. Our platform allows you to monetize your content regardless of your location.',
                'success-title': 'Success Stories',
                'success-subtitle': 'Meet creators who transformed their lives with our platform',
                'creator1-name': 'Marina Silva',
                'creator1-category': 'Fitness & Lifestyle',
                'creator1-story': '"I\'ve been working from Bali for 2 years, creating fitness and wellness content. The platform allowed me complete geographic freedom while building a global community of over 15,000 subscribers."',
                'creator1-location': 'Bali, Indonesia',
                'creator2-name': 'Carlos Rodriguez',
                'creator2-category': 'Culinary & Gastronomy',
                'creator2-story': '"I travel the world exploring local cuisines and share exclusive recipes. My 8,500 subscribers pay for premium content they can only find here. The freedom to work from any kitchen in the world is incredible!"',
                'creator2-location': 'Lisbon, Portugal',
                'monthly-revenue': '/month',
                'custom-rates': 'Custom Rates',
                'pricing-subtitle': 'Choose the ideal plan for your business. Custom rates based on your volume and needs.',
                'plan-starter-desc': 'Based on your volume',
                'plan-pro-desc': 'Based on your volume',
                'plan-enterprise-desc': 'Based on your volume',
                'pricing-note': '* Our rates are customized based on your transaction volume and specific needs.',
                'pricing-details': 'No setup fees, no fixed monthly fees. Contact us to learn about your custom rate.',
                'cta-title': 'Ready to Start?',
                'cta-description': 'Join thousands of creators who are already monetizing their content intelligently and profitably.',
                'start-free': 'Start for Free',
                <!-- Atualizadas traduções para Lux Secrets -->
                'footer-description': 'The ultimate platform for exclusive content creators.',
                'footer-product': 'Product',
                'footer-features': 'Features',
                'footer-pricing': 'Pricing',
                'footer-security': 'Security',
                'footer-support': 'Support',
                'footer-help': 'Help Center',
                'footer-contact': 'Contact',
                'footer-social': 'Social Media',
                'footer-rights': 'All rights reserved.',
                'privacy-section1': '1. Information Collection',
                'privacy-content1': 'We collect information you provide directly to us, such as when you create an account, publish content, or contact us. This may include your name, email address, payment information, and content you choose to share.',
                'privacy-section2': '2. Use of Information',
                'privacy-content2': 'We use your information to provide, maintain and improve our services, process transactions, send service-related communications and personalize your platform experience.',
                'privacy-section3': '3. Information Sharing',
                'privacy-content3': 'We do not sell, rent or share your personal information with third parties for commercial purposes, except as described in this policy or with your explicit consent.',
                'privacy-section4': '4. Cookies and Similar Technologies',
                'privacy-content4': 'We use cookies and similar technologies to improve your experience, analyze site usage and personalize content. You can control cookie usage through your browser settings.',
                'privacy-section5': '5. Security',
                'privacy-content5': 'We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure or destruction.',
                'privacy-section6': '6. Your Rights',
                'privacy-content6': 'You have the right to access, update, correct or delete your personal information. You can also opt out of receiving certain marketing communications from us.'
            },
            es: {
                'cookie-message': 'Utilizamos cookies para mejorar tu experiencia. Al continuar navegando, aceptas nuestra política de privacidad.',
                'accept': 'Aceptar',
                'privacy-policy': 'Política de Privacidad',
                'login': 'Iniciar Sesión',
                'hero-title': 'Monetiza Tu Contenido',
                'hero-subtitle': 'de Forma Exclusiva',
                'hero-description': 'La plataforma definitiva para creadores de contenido que desean convertir su pasión en ingresos recurrentes a través de suscripciones exclusivas.',
                'start-now': 'Comenzar Ahora',
                'watch-demo': 'Ver Demo',
                <!-- Atualizadas traduções para Lux Secrets -->
                'features-title': '¿Por qué elegir Lux Secrets?',
                'features-subtitle': 'Ofrecemos las mejores herramientas para que puedas crear, gestionar y monetizar tu contenido exclusivo.',
                'feature1-title': 'Contenido Exclusivo',
                'feature1-description': 'Crea contenido privado y exclusivo para tus suscriptores más fieles, aumentando el engagement y la fidelización.',
                'feature2-title': 'Ingresos Recurrentes',
                'feature2-description': 'Sistema de suscripciones mensuales, trimestrales y anuales que garantizan ingresos estables y predecibles.',
                'feature3-title': 'Libertad Geográfica',
                'feature3-description': 'Trabaja desde cualquier lugar del mundo. Nuestra plataforma te permite monetizar tu contenido independientemente de tu ubicación.',
                'success-title': 'Casos de Éxito',
                'success-subtitle': 'Conoce creadores que transformaron sus vidas con nuestra plataforma',
                'creator1-name': 'Marina Silva',
                'creator1-category': 'Fitness y Estilo de Vida',
                'creator1-story': '"He estado trabajando desde Bali durante 2 años, creando contenido de fitness y bienestar. La plataforma me permitió tener libertad geográfica total mientras construyo una comunidad global de más de 15,000 suscriptores."',
                'creator1-location': 'Bali, Indonesia',
                'creator2-name': 'Carlos Rodriguez',
                'creator2-category': 'Culinaria y Gastronomía',
                'creator2-story': '"Viajo por el mundo explorando cocinas locales y comparto recetas exclusivas. Mis 8,500 suscriptores pagan por contenido premium que solo encuentran aquí. ¡La libertad de trabajar desde cualquier cocina del mundo es increíble!"',
                'creator2-location': 'Lisboa, Portugal',
                'monthly-revenue': '/mes',
                'custom-rates': 'Tarifas Personalizadas',
                'pricing-subtitle': 'Elige el plan ideal para tu negocio. Tarifas personalizadas basadas en tu volumen y necesidades.',
                'plan-starter-desc': 'Basado en tu volumen',
                'plan-pro-desc': 'Basado en tu volumen',
                'plan-enterprise-desc': 'Basado en tu volumen',
                'pricing-note': '* Nuestras tarifas son personalizadas basadas en tu volumen de transacciones y necesidades específicas.',
                'pricing-details': 'Sin tarifas de configuración, sin mensualidades fijas. Contáctanos para conocer tu tarifa personalizada.',
                'cta-title': '¿Listo para Comenzar?',
                'cta-description': 'Únete a miles de creadores que ya están monetizando su contenido de forma inteligente y rentable.',
                'start-free': 'Comenzar Gratis',
                <!-- Atualizadas traduções para Lux Secrets -->
                'footer-description': 'La plataforma definitiva para creadores de contenido exclusivo.',
                'footer-product': 'Producto',
                'footer-features': 'Características',
                'footer-pricing': 'Precios',
                'footer-security': 'Seguridad',
                'footer-support': 'Soporte',
                'footer-help': 'Centro de Ayuda',
                'footer-contact': 'Contacto',
                'footer-social': 'Redes Sociales',
                'footer-rights': 'Todos los derechos reservados.',
                'privacy-section1': '1. Recopilación de Información',
                'privacy-content1': 'Recopilamos información que nos proporcionas directamente, como cuando creas una cuenta, publicas contenido o te pones en contacto con nosotros. Esto puede incluir tu nombre, dirección de correo electrónico, información de pago y contenido que eliges compartir.',
                'privacy-section2': '2. Uso de la Información',
                'privacy-content2': 'Utilizamos tu información para proporcionar, mantener y mejorar nuestros servicios, procesar transacciones, enviar comunicaciones relacionadas con el servicio y personalizar tu experiencia en la plataforma.',
                'privacy-section3': '3. Compartir Información',
                'privacy-content3': 'No vendemos, alquilamos o compartimos tu información personal con terceros con fines comerciales, excepto como se describe en esta política o con tu consentimiento explícito.',
                'privacy-section4': '4. Cookies y Tecnologías Similares',
                'privacy-content4': 'Utilizamos cookies y tecnologías similares para mejorar tu experiencia, analizar el uso del sitio y personalizar el contenido. Puedes controlar el uso de cookies a través de la configuración de tu navegador.',
                'privacy-section5': '5. Seguridad',
                'privacy-content5': 'Implementamos medidas de seguridad técnicas y organizacionales apropiadas para proteger tu información personal contra acceso no autorizado, alteración, divulgación o destrucción.',
                'privacy-section6': '6. Tus Derechos',
                'privacy-content6': 'Tienes derecho a acceder, actualizar, corregir o eliminar tu información personal. También puedes optar por no recibir ciertas comunicaciones de marketing de nuestra parte.'
            }
        };

        let currentLanguage = 'pt';

        function changeLanguage() {
            const selector = document.getElementById('languageSelector');
            currentLanguage = selector.value;
            
            const elements = document.querySelectorAll('[data-translate]');
            elements.forEach(element => {
                const key = element.getAttribute('data-translate');
                if (translations[currentLanguage] && translations[currentLanguage][key]) {
                    element.textContent = translations[currentLanguage][key];
                }
            });
            
            // Salvar preferência no localStorage
            localStorage.setItem('preferred-language', currentLanguage);
        }

        function showCookieBanner() {
            const banner = document.getElementById('cookieBanner');
            if (!localStorage.getItem('cookies-accepted')) {
                banner.classList.remove('translate-y-full');
            }
        }

        function acceptCookies() {
            localStorage.setItem('cookies-accepted', 'true');
            document.getElementById('cookieBanner').classList.add('translate-y-full');
        }

        function showPrivacyModal() {
            document.getElementById('privacyModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hidePrivacyModal() {
            document.getElementById('privacyModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function toggleLibras() {
            const librasVideo = document.getElementById('librasVideo');
            librasVideo.classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Carregar idioma salvo
            const savedLanguage = localStorage.getItem('preferred-language');
            if (savedLanguage && translations[savedLanguage]) {
                currentLanguage = savedLanguage;
                document.getElementById('languageSelector').value = savedLanguage;
                changeLanguage();
            }
            
            // Mostrar banner de cookies se necessário
            setTimeout(showCookieBanner, 1000);
            
            // Fechar modal ao clicar fora
            document.getElementById('privacyModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hidePrivacyModal();
                }
            });
            
            // Animações de scroll
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
            
            // Observar elementos para animação
            document.querySelectorAll('section').forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(section);
            });
        });

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
    </script>
</body>
</html>
