@extends('layouts.guest')

@section('title', $creator->display_name . ' - Perfil')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header da aplicação -->
    <div class="bg-white border-b border-gray-200 sticky top-0 z-40">
        <div class="max-w-4xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-bold text-gray-900">luxSecrets.</h1>
                <!-- Adicionado seletor de idiomas -->
                <div class="relative">
                    <button onclick="toggleLanguageMenu()" class="p-2 flex items-center space-x-1">
                        <i data-lucide="globe" class="w-5 h-5 text-gray-600"></i>
                        <span id="currentLang" class="text-sm text-gray-600">PT</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-600"></i>
                    </button>
                    <div id="languageMenu" class="hidden absolute right-0 top-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <button onclick="changeLanguage('pt')" class="block w-full px-4 py-2 text-left text-sm hover:bg-gray-50">🇧🇷 Português</button>
                        <button onclick="changeLanguage('en')" class="block w-full px-4 py-2 text-left text-sm hover:bg-gray-50">🇺🇸 English</button>
                        <button onclick="changeLanguage('es')" class="block w-full px-4 py-2 text-left text-sm hover:bg-gray-50">🇪🇸 Español</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container principal -->
    <div class="max-w-4xl mx-auto bg-white">
        <!-- Foto de Capa -->
        <div class="relative h-48 md:h-64 bg-gradient-to-br from-purple-500 via-pink-500 to-purple-600 overflow-hidden">
            @if($creator->cover_image)
                <img src="{{ Storage::url($creator->cover_image) }}" alt="Capa" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/30 via-pink-500/30 to-purple-600/30"></div>
            @endif
            
            <!-- Avatar sobreposto -->
            <div class="absolute bottom-4 left-4">
                <div class="w-16 h-16 md:w-20 md:h-20 rounded-full border-3 border-white overflow-hidden">
                    @if($creator->profile_image)
                        <img src="{{ Storage::url($creator->profile_image) }}" alt="{{ $creator->display_name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                            <span class="text-xl font-bold text-gray-600">{{ substr($creator->display_name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Zeradas todas as estatísticas no header -->
            <div class="absolute bottom-4 right-4 flex items-center space-x-4 text-white text-sm">
                <div class="flex items-center space-x-1">
                    <i data-lucide="image" class="w-4 h-4"></i>
                    <span>0</span>
                </div>
                <div class="flex items-center space-x-1">
                    <i data-lucide="video" class="w-4 h-4"></i>
                    <span>0</span>
                </div>
                <div class="flex items-center space-x-1">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    <span>0</span>
                </div>
                <div class="flex items-center space-x-1">
                    <i data-lucide="heart" class="w-4 h-4"></i>
                    <span>0</span>
                </div>
            </div>
        </div>

        <!-- Informações do Perfil -->
        <div class="p-4 md:p-6">
            <div class="flex items-center space-x-2 mb-2">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">{{ $creator->display_name }}</h1>
                @if($creator->is_verified)
                    <i data-lucide="check-circle" class="w-5 h-5 text-black"></i>
                @endif
            </div>
            <p class="text-gray-600 mb-1">{{ '@' . $creator->username }}</p>
            
            <!-- Adicionada funcionalidade "Ler mais" com bio completa -->
            <div id="bioSection">
                <p class="text-gray-800 mb-2" id="bioShort">📍 São Paulo, SP, Brasil | Maceió, AL, Brasil<br>💻 Especialista em Desenvolvimento de Software...</p>
                <button onclick="toggleBio()" class="text-black text-sm font-medium" id="bioToggle" data-lang-key="read_more">Ler mais</button>
                
                <div id="bioFull" class="hidden text-gray-800 mb-2 text-sm leading-relaxed">
                    <p class="mb-3">📍 São Paulo, SP, Brasil | Maceió, AL, Brasil<br>💻 Especialista em Desenvolvimento de Software, Gestão de Projetos e Metodologias Ágeis</p>
                    
                    <p class="mb-3">Apaixonado por tecnologia e inovação, atuo há mais de 8 anos no desenvolvimento de soluções robustas e escaláveis que impulsionam negócios. Com expertise em backend e frontend, domino linguagens como Java, Python, PHP, Node.js, entre outras, além de frameworks como Spring Boot e Laravel.</p>
                    
                    <p class="mb-3">Minha jornada profissional inclui papéis de liderança como Project Manager, Product Owner e Scrum Master, onde gerenciei equipes multidisciplinares e implementei metodologias ágeis para garantir a entrega de projetos dentro dos prazos e objetivos estratégicos.</p>
                    
                    <p class="mb-3"><strong>Principais Habilidades:</strong><br>
                    Desenvolvimento Backend: APIs RESTful, Microservices, DevOps e OpenFinance.<br>
                    Gestão de Projetos: Planejamento estratégico, gerenciamento de riscos e aplicação de frameworks como PMBOK e Scrum.<br>
                    Ensino e Treinamento: Instrutor de backend no SENAI-AL, capacitando profissionais com habilidades práticas e avançadas de programação.</p>
                    
                    <p class="mb-3"><strong>Conquistas e Impactos:</strong><br>
                    • Líder na criação do CRM da Rede My Box, implementado em mais de 200 unidades.<br>
                    • Responsável por sistemas judiciais amplamente usados no TJ-AL, como o Banco de Peritos e o Sistema de Plantão.<br>
                    • Pioneiro na implementação de soluções SaaS em mercados diversos, incluindo áreas de turismo e franquias.<br>
                    • 1º lugar no OPEN INNOVATION Turismo, destacando-se com um projeto inovador no setor.</p>
                    
                    <p>Sou movido por desafios e comprometido com a entrega de valor por meio da tecnologia. Se busca um profissional com experiência sólida e abordagem focada em resultados, conecte-se comigo.</p>
                </div>
            </div>

            <!-- Redes Sociais -->
            @if($creator->twitter_url || $creator->tiktok_url)
                <div class="flex items-center space-x-4 mt-3">
                    @if($creator->twitter_url)
                        <a href="{{ $creator->twitter_url }}" target="_blank" class="text-gray-600">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                    @endif
                    @if($creator->tiktok_url)
                        <a href="{{ $creator->tiktok_url }}" target="_blank" class="text-gray-600">
                            <i data-lucide="music" class="w-5 h-5"></i>
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <!-- Assinaturas -->
        <div class="px-4 md:px-6 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3" data-lang-key="subscriptions">Assinaturas</h3>
            
            <!-- Plano Principal -->
            <button onclick="openSubscriptionModal({{ json_encode($plans[0]) }})" 
                    class="w-full p-4 bg-black rounded-2xl text-white mb-4 flex items-center justify-between hover:bg-gray-800 transition-colors">
                <span class="font-medium" data-lang-key="one_month">1 mês</span>
                <span class="font-bold">R$ {{ number_format($plans[0]['price'], 2, ',', '.') }}</span>
            </button>

            <!-- Promoções -->
            <div class="border border-gray-200 rounded-2xl overflow-hidden">
                <button onclick="togglePromocoes()" class="w-full p-4 flex items-center justify-between bg-gray-50">
                    <span class="font-medium text-gray-900" data-lang-key="promotions">Promoções</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 text-gray-600 transition-transform" id="promocoes-icon"></i>
                </button>
                
                <div id="promocoes-content" class="hidden">
                    @foreach(array_slice($plans, 1) as $plan)
                        <button onclick="openSubscriptionModal({{ json_encode($plan) }})" 
                                class="w-full p-4 bg-black text-white flex items-center justify-between border-t border-gray-300 hover:bg-gray-800 transition-colors">
                            <div class="text-left">
                                <div class="font-medium">{{ $plan['name'] }}</div>
                                @if(isset($plan['discount']))
                                    <div class="text-sm opacity-90">({{ $plan['discount'] }} off)</div>
                                @endif
                            </div>
                            <span class="font-bold">R$ {{ number_format($plan['price'], 2, ',', '.') }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Abas de Conteúdo -->
        <div class="border-t border-gray-200">
            <div class="flex">
                <button class="flex-1 py-4 text-center border-b-2 border-black text-black font-medium">
                    <i data-lucide="grid-3x3" class="w-5 h-5 mx-auto mb-1"></i>
                    <!-- Zeradas estatísticas das abas -->
                    <div class="text-sm"><span data-lang-key="posts">0 Postagens</span></div>
                </button>
                <button class="flex-1 py-4 text-center text-gray-600">
                    <i data-lucide="video" class="w-5 h-5 mx-auto mb-1"></i>
                    <div class="text-sm"><span data-lang-key="media">0 Mídias</span></div>
                </button>
            </div>
        </div>

        <!-- Preview do Conteúdo Bloqueado -->
        <div class="p-4 md:p-6">
            <div class="bg-gray-100 rounded-2xl p-8 text-center">
                <div class="w-16 h-16 bg-gray-300 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i data-lucide="lock" class="w-8 h-8 text-gray-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">{{ $creator->display_name }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ '@' . $creator->username }}</p>
                
                <!-- Zeradas estatísticas do preview -->
                <div class="flex items-center justify-center space-x-6 text-sm text-gray-600 mb-6">
                    <div class="flex items-center space-x-1">
                        <i data-lucide="image" class="w-4 h-4"></i>
                        <span>0</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <i data-lucide="video" class="w-4 h-4"></i>
                        <span>0</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <i data-lucide="heart" class="w-4 h-4"></i>
                        <span>0</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span>0</span>
                    </div>
                </div>

                <p class="text-gray-600 text-sm" data-lang-key="subscribe_message">Assine para ver o conteúdo exclusivo</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Assinatura -->
<div id="subscriptionModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Finalizar Assinatura</h3>
                <button onclick="closeSubscriptionModal()" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <div id="selectedPlan" class="mb-6 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl">
                <!-- Plano selecionado será inserido aqui -->
            </div>

            <form id="subscriptionForm" action="" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telefone (opcional)</label>
                        <input type="tel" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 py-3 px-4 bg-black text-white font-medium rounded-xl hover:bg-gray-800 transition-colors">
                    Continuar para Pagamento
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let selectedPlan = null;
    let currentLanguage = 'pt';

    const translations = {
        pt: {
            subscriptions: 'Assinaturas',
            one_month: '1 mês',
            promotions: 'Promoções',
            posts: '0 Postagens',
            media: '0 Mídias',
            subscribe_message: 'Assine para ver o conteúdo exclusivo',
            read_more: 'Ler mais',
            read_less: 'Ler menos'
        },
        en: {
            subscriptions: 'Subscriptions',
            one_month: '1 month',
            promotions: 'Promotions',
            posts: '0 Posts',
            media: '0 Media',
            subscribe_message: 'Subscribe to see exclusive content',
            read_more: 'Read more',
            read_less: 'Read less'
        },
        es: {
            subscriptions: 'Suscripciones',
            one_month: '1 mes',
            promotions: 'Promociones',
            posts: '0 Publicaciones',
            media: '0 Medios',
            subscribe_message: 'Suscríbete para ver contenido exclusivo',
            read_more: 'Leer más',
            read_less: 'Leer menos'
        }
    };

    function toggleLanguageMenu() {
        const menu = document.getElementById('languageMenu');
        menu.classList.toggle('hidden');
    }

    function changeLanguage(lang) {
        currentLanguage = lang;
        document.getElementById('currentLang').textContent = lang.toUpperCase();
        document.getElementById('languageMenu').classList.add('hidden');
        
        // Atualizar textos na página
        document.querySelectorAll('[data-lang-key]').forEach(element => {
            const key = element.getAttribute('data-lang-key');
            if (translations[lang][key]) {
                element.textContent = translations[lang][key];
            }
        });
    }

    function toggleBio() {
        const bioShort = document.getElementById('bioShort');
        const bioFull = document.getElementById('bioFull');
        const bioToggle = document.getElementById('bioToggle');
        
        if (bioFull.classList.contains('hidden')) {
            bioShort.classList.add('hidden');
            bioFull.classList.remove('hidden');
            bioToggle.textContent = translations[currentLanguage].read_less;
        } else {
            bioShort.classList.remove('hidden');
            bioFull.classList.add('hidden');
            bioToggle.textContent = translations[currentLanguage].read_more;
        }
    }

    // Fechar menu de idiomas ao clicar fora
    document.addEventListener('click', function(e) {
        const languageMenu = document.getElementById('languageMenu');
        const languageButton = e.target.closest('button[onclick="toggleLanguageMenu()"]');
        
        if (!languageButton && !languageMenu.contains(e.target)) {
            languageMenu.classList.add('hidden');
        }
    });

    // Fechar modal ao clicar fora
    document.getElementById('subscriptionModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSubscriptionModal();
        }
    });

    function openSubscriptionModal(plan) {
        selectedPlan = plan;
        
        // Atualizar o formulário com a action correta
        document.getElementById('subscriptionForm').action = `{{ url('/criador/' . $creator->username . '/assinar') }}/${plan.id}`;
        
        // Mostrar informações do plano selecionado
        document.getElementById('selectedPlan').innerHTML = `
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="font-bold text-gray-900">${plan.name}</h4>
                    <p class="text-sm text-gray-600">${plan.description}</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-gray-900">R$ ${plan.price.toFixed(2).replace('.', ',')}</div>
                    <div class="text-sm text-gray-600">por ${plan.period}</div>
                </div>
            </div>
        `;
        
        document.getElementById('subscriptionModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeSubscriptionModal() {
        document.getElementById('subscriptionModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function togglePromocoes() {
        const content = document.getElementById('promocoes-content');
        const icon = document.getElementById('promocoes-icon');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }

    // Inicializar ícones Lucide
    lucide.createIcons();
</script>
@endpush
