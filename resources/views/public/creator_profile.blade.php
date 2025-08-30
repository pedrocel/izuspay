@extends('layouts.guest')

@section('title', $creator->display_name . ' - Perfil')

@section('content')
<style>
        .cover-container {
            height: 40vh; /* Altura relativa à tela */
            max-height: 400px; /* Altura máxima */
            min-height: 250px; /* Altura mínima */
        }
        
        @media (max-width: 768px) {
            .cover-container {
                height: 30vh; /* Menor altura em dispositivos móveis */
                max-height: 300px;
            }
        }
        
        .profile-avatar {
            margin-top: -55px; /* Ajuste para sobreposição */
        }
    </style>
<div class="min-h-screen bg-gray-50">
    <!-- Header da aplicação -->
    <div class="bg-white border-b border-gray-200 sticky top-0 z-40">
        <div class="max-w-4xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <a href="https://luxsecrets.shop/" class="text-lg font-bold text-gray-900">luxSecrets.</a>
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

   <div class="relative h-32 overflow-hidden">
    @if($creator->cover_image)
       <div class="relative h-32 overflow-hidden flex items-center justify-center">
    <img class="bg-image min-w-full min-h-full object-cover object-center" 
         src="{{ Storage::url($creator->cover_image) }}" 
         loading="lazy" 
         alt="Capa de {{ $creator->display_name }}">
</div>

    @else
        <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-pink-600 to-red-600"></div>
    @endif
    
    <!-- Stats no canto superior direito -->
    <div class="medias-container absolute top-4 right-4 z-20">
        <div class="count-container">
            <div class="count-list flex items-center space-x-4 text-white text-sm">
                <div class="stat-display">
                    <div class="count-item flex items-center space-x-1">
                        <i data-lucide="image" class="w-4 h-4"></i>
                        <span>{{ $creator->totalPosts() }}</span>
                    </div>
                </div>
                <div class="stat-display">
                    <div class="count-item flex items-center space-x-1">
                        <i data-lucide="video" class="w-4 h-4"></i>
                        <span>0</span>
                    </div>
                </div>
                <div class="stat-display">
                    <div class="count-item flex items-center space-x-1">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                        <span>0</span>
                    </div>
                </div>
                <div class="stat-display">
                    <div class="count-item flex items-center space-x-1">
                        <i data-lucide="heart" class="w-4 h-4"></i>
                        <span>{{ $creator->totalLikes() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Container principal com ajuste de margem superior -->
    <div class="max-w-4xl mx-auto bg-white">
        <!-- Profile Info abaixo da hero com ajuste de posicionamento -->
        <div class="px-6 pb-6 profile-avatar relative z-10">
            <!-- Avatar com borda mais suave -->
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg mb-4">
                @if($creator->profile_image)
                    <img src="{{ Storage::url($creator->profile_image) }}" alt="{{ $creator->display_name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-600">{{ substr($creator->display_name, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            <!-- Restante do conteúdo do perfil -->
            <div class="flex items-center space-x-2 mb-2">
                <h1 class="text-xl font-bold text-black">{{ $creator->display_name }}</h1>
                @if($creator->is_verified)
                    <i data-lucide="check-circle" class="w-5 h-5 text-orange-500"></i>
                @endif
            </div>
            
            <p class="text-gray-600 mb-4">{{ '@' . $creator->username }}</p>

            <!-- Bio -->
            @if($creator->bio)
                <p class="text-gray-800 mb-4 text-sm leading-relaxed">{{ $creator->bio }} <span class="text-orange-500 cursor-pointer">Ler mais</span></p>
            @endif

            <!-- Redes Sociais -->
            @if($creator->twitter_url || $creator->tiktok_url || $creator->instagram_url)
                <div class="flex items-center space-x-4 mb-6">
                    @if($creator->twitter_url)
                        <a href="{{ $creator->twitter_url }}" target="_blank" class="text-gray-600 hover:text-black transition-colors">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                    @endif
                    @if($creator->tiktok_url)
                        <a href="{{ $creator->tiktok_url }}" target="_blank" class="text-gray-600 hover:text-black transition-colors">
                            <i data-lucide="music" class="w-5 h-5"></i>
                        </a>
                    @endif
                    @if($creator->instagram_url)
                        <a href="{{ $creator->instagram_url }}" target="_blank" class="text-gray-600 hover:text-pink-500 transition-colors">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                    @endif
                </div>
            @endif

            <!-- Seção de Assinaturas -->
            <div class="mb-6">
                <h3 class="font-semibold text-black mb-3">Assinaturas</h3>
                
                @if($plans->count() > 0)
                    @foreach($plans as $plan)
                        <button id="buyButton" data-hash="{{ $plan->hash_id }}" 
                                class="w-full mb-3 p-4 bg-gradient-to-r from-orange-400 to-pink-400 text-white rounded-full font-medium hover:from-orange-500 hover:to-pink-500 transition-all duration-200 shadow-lg">
                            <div class="flex items-center justify-between">
                                <span style="color: #000">{{ $plan->name }}</span>
                                <span class="font-bold" style="color: #000"> {{ $plan->formatted_priceT }}</span>
                            </div>
                        </button>
                    @endforeach
                @endif
            </div>

            <!-- Tabs de conteúdo -->
            <div class="border-b border-gray-200">
                <div class="flex space-x-8">
                    <button class="flex items-center space-x-2 pb-3 border-b-2 border-orange-500 text-orange-500">
                        <i data-lucide="grid-3x3" class="w-4 h-4"></i>
                        <span class="text-sm font-medium">{{ $creator->totalPosts() }} Postagens</span>
                    </button>
                    <button class="flex items-center space-x-2 pb-3 text-gray-500">
                        <i data-lucide="play-circle" class="w-4 h-4"></i>
                        <span class="text-sm">585 Mídias</span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Feed de Posts -->
        <div class="pb-4">
            <!-- Post simulado com cadeado -->
            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="bg-white border-b border-gray-200">
                        <!-- Header do Post -->
                        <div class="flex items-center justify-between p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full overflow-hidden">
                                    @if($creator->profile_image)
                                        <img src="{{ Storage::url($creator->profile_image) }}" alt="{{ $creator->display_name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-xs font-bold text-gray-600">{{ substr($creator->display_name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-gray-900">{{ $creator->display_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            @if(!$post->is_private)
                                <i data-lucide="more-horizontal" class="w-5 h-5 text-gray-400"></i>
                            @else
                                <div class="flex items-center space-x-1 text-xs text-gray-500">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                    <span>Exclusivo</span>
                                </div>
                            @endif
                        </div>

                        <!-- Imagem do Post -->
                        @if($post->featured_image)
                            <div class="relative">
                                <div class="aspect-square bg-gray-100 relative overflow-hidden">
                                    @if(!$post->is_private || $isSubscriber)
                                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover filter blur-lg scale-110">
                                        
                                        <div class="absolute inset-0 bg-gradient-to-r from-orange-400/80 to-pink-400/80 flex items-center justify-center">
                                            <div class="text-center text-white">
                                                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-2xl animate-pulse">
                                                    <i data-lucide="lock" class="w-10 h-10 text-white"></i>
                                                </div>
                                                <h3 class="font-bold text-xl mb-2">Conteúdo Exclusivo</h3>
                                                <p class="text-white/90 mb-4 text-sm">Assine para ver este conteúdo</p>
                                                @if($plans->count() > 0)
                                                    <button onclick="openSubscriptionModal({{ json_encode($plans->first()) }})" 
                                                            class="bg-white text-orange-500 px-6 py-3 rounded-full text-sm font-bold hover:bg-gray-100 transition-all duration-200 shadow-lg">
                                                        Assinar R$ {{ $plans->first()->formatted_price }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Ações do Post -->
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-4">
                                    @if(!$post->is_private || $isSubscriber)
                                        {{-- <button onclick="toggleLike({{ $post->id }})" class="hover:text-red-500 transition-colors">
                                            <i data-lucide="heart" class="w-6 h-6"></i>
                                        </button>
                                        <button class="hover:text-blue-500 transition-colors">
                                            <i data-lucide="message-circle" class="w-6 h-6"></i>
                                        </button>
                                        <button class="hover:text-green-500 transition-colors">
                                            <i data-lucide="send" class="w-6 h-6"></i>
                                        </button> --}}
                                    @else
                                        <div class="flex items-center space-x-4 opacity-50">
                                            {{-- <i data-lucide="heart" class="w-6 h-6"></i>
                                            <i data-lucide="message-circle" class="w-6 h-6"></i>
                                            <i data-lucide="send" class="w-6 h-6"></i> --}}
                                        </div>
                                    @endif
                                </div>
                                {{-- <button class="hover:text-gray-700 transition-colors">
                                    <i data-lucide="bookmark" class="w-6 h-6"></i>
                                </button> --}}
                            </div>

                            {{-- @if(!$post->is_private || $isSubscriber)
                                <p class="font-semibold text-sm mb-2">{{ $post->likes_count ?? 0 }} curtidas</p>
                            @endif --}}

                            <div class="text-sm">
                                <span class="font-semibold">{{ $creator->display_name }}</span>
                                @if(!$post->is_private || $isSubscriber)
                                    <span class="ml-2">{{ $post->content }}</span>
                                @else
                                    <span class="ml-2 text-gray-500 italic">Conteúdo disponível apenas para assinantes</span>
                                @endif
                            </div>

                            {{-- @if((!$post->is_private || $isSubscriber) && $post->tags)
                                <div class="mt-2">
                                    @if(is_array($post->tags))
                                        @foreach($post->tags as $tag)
                                            <span class="text-blue-500 text-sm mr-2">#{{ trim($tag) }}</span>
                                        @endforeach
                                    @else
                                        @foreach(explode(',', $post->tags) as $tag)
                                            <span class="text-blue-500 text-sm mr-2">#{{ trim($tag) }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endif --}}
                        </div>
                    </div>
                @endforeach

                @if($posts->hasPages())
                    <div class="p-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <!-- Estado vazio -->
            @endif
        </div>

        <!-- CTA para Não-Assinantes com Cores Melhoradas -->
        @if(!$isSubscriber && $creator->totalPrivatePosts() > 0)
            <div class="p-6 border-t border-gray-200">
                <div class="bg-gradient-to-br from-purple-50 via-pink-50 to-purple-100 rounded-3xl p-8 text-center relative overflow-hidden border border-purple-100">
                    <!-- Padrão decorativo de fundo -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239333ea" fill-opacity="0.3"%3E%3Ccircle cx="30" cy="30" r="1.5"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
                    </div>

                    <!-- Ícone do cadeado melhorado -->
                    <div class="relative z-10 w-24 h-24 bg-gradient-to-r from-purple-500 via-pink-500 to-purple-600 rounded-full mx-auto mb-6 flex items-center justify-center shadow-2xl animate-pulse">
                        <i data-lucide="crown" class="w-12 h-12 text-white"></i>
                    </div>

                    <!-- Conteúdo melhorado -->
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Conteúdo Premium Bloqueado</h3>
                    <p class="text-gray-600 mb-6 text-lg leading-relaxed max-w-md mx-auto">
                        Desbloqueie <strong class="text-purple-600">{{ $creator->totalPrivatePosts() }} posts exclusivos</strong> de <strong class="text-pink-600">{{ $creator->display_name }}</strong>
                    </p>

                    <!-- Lista de benefícios -->
                    <div class="flex flex-wrap justify-center gap-3 mb-8">
                        <span class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-medium">
                            <i data-lucide="image" class="w-4 h-4 inline mr-1"></i>
                            Fotos Exclusivas
                        </span>
                        <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full text-sm font-medium">
                            <i data-lucide="video" class="w-4 h-4 inline mr-1"></i>
                            Vídeos Premium
                        </span>
                        <span class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-medium">
                            <i data-lucide="message-heart" class="w-4 h-4 inline mr-1"></i>
                            Acesso Direto
                        </span>
                    </div>

                    <!-- Botões de planos melhorados -->
                    @if($plans->count() > 0)
                        <div class="space-y-3">
                            @foreach($plans as $plan) 
                                <button id="buyButton" data-hash="{{ $plan->hash_id }}"
                                        class="w-full bg-gradient-to-r from-purple-600 via-pink-600 to-purple-700 text-white px-8 py-4 rounded-2xl font-bold hover:from-purple-700 hover:via-pink-700 hover:to-purple-800 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 relative overflow-hidden group">
                                    <!-- Efeito brilho -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 group-hover:translate-x-full transition-transform duration-1000"></div>
                                    <div class="relative z-10 flex items-center justify-center space-x-2">
                                        <i data-lucide="sparkles" class="w-5 h-5"></i>
                                        <span>Assinar {{ $plan->name }} - R$ {{ $plan->formatted_priceT }}</span>
                                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @endif

                    <!-- Garantia -->
                    <p class="text-xs text-gray-500 mt-4 flex items-center justify-center space-x-1">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                        <span>Pagamento 100% seguro • Cancele quando quiser</span>
                    </p>
                </div>
            </div>
        @endif
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
            posts: 'Postagens',
            media: 'Mídias',
            subscribe_message: 'Assine para ver o conteúdo exclusivo',
            read_more: 'Ler mais',
            read_less: 'Ler menos'
        },
        en: {
            subscriptions: 'Subscriptions',
            one_month: '1 month',
            promotions: 'Promotions',
            posts: 'Posts',
            media: 'Media',
            subscribe_message: 'Subscribe to see exclusive content',
            read_more: 'Read more',
            read_less: 'Read less'
        },
        es: {
            subscriptions: 'Suscripciones',
            one_month: '1 mes',
            promotions: 'Promociones',
            posts: 'Publicaciones',
            media: 'Medios',
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

    function toggleLike(postId) {
        // Implementar funcionalidade de curtir
        console.log('Toggle like for post:', postId);
        // Aqui você pode fazer uma requisição AJAX para curtir/descurtir o post
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

    function showTab(tab) {
        // Implementar troca de abas se necessário
        console.log('Showing tab:', tab);
    }

    // Inicializar ícones Lucide
    lucide.createIcons();

    document.getElementById('buyButton').addEventListener('click', function() {
        const hashId = this.dataset.hash;

        // Captura todos os UTM params da URL atual
        const urlParams = new URLSearchParams(window.location.search);
        const utmParams = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];
        let queryString = '';

        utmParams.forEach(param => {
            if (urlParams.has(param)) {
                queryString += `${param}=${encodeURIComponent(urlParams.get(param))}&`;
            }
        });

        // Remove o & final
        if (queryString.endsWith('&')) {
            queryString = queryString.slice(0, -1);
        }

        // Redireciona para a rota de checkout
        const checkoutUrl = `/checkout/product/${hashId}${queryString ? '?' + queryString : ''}`;
        window.location.href = checkoutUrl;
    });
</script>
@endpush