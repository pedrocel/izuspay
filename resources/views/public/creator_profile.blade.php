@extends('layouts.guest')

@section('title', $creator->display_name . ' - Perfil')

@section('content')
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

    <!-- Adicionando Hero Section com imagem de fundo -->
    <div class="relative h-80 bg-gradient-to-br from-purple-600 via-pink-600 to-red-600 overflow-hidden">
        <!-- Imagem de fundo -->
        @if($creator->cover_image)
            <img src="{{ Storage::url($creator->cover_image) }}" alt="Cover" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-pink-600 to-red-600"></div>
        @endif
        
        <!-- Conteúdo do Hero -->
        <div class="relative z-10 h-full flex items-end">
            <div class="max-w-4xl mx-auto px-4 pb-8 w-full">
                <div class="flex items-end space-x-6">
                    <!-- Avatar grande -->
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        @if($creator->profile_image)
                            <img src="{{ Storage::url($creator->profile_image) }}" alt="{{ $creator->display_name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                <span class="text-4xl font-bold text-gray-600">{{ substr($creator->display_name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Info do Criador -->
                    <div class="flex-1 text-white">
                        <div class="flex items-center space-x-3 mb-2">
                            <h1 class="text-3xl font-bold">{{ $creator->display_name }}</h1>
                            @if($creator->is_verified)
                                <i data-lucide="check-circle" class="w-6 h-6 text-blue-400"></i>
                            @endif
                        </div>
                        <p class="text-white/80 mb-3">{{ '@' . $creator->username }}</p>
                        
                        <!-- Estatísticas -->
                        <div class="flex items-center space-x-6 text-sm">
                            <span><strong>{{ $creator->totalPosts() }}</strong> posts</span>
                            <span><strong>{{ $creator->totalActiveSubscribers() }}</strong> assinantes</span>
                            <span><strong>{{ $creator->totalLikes() }}</strong> curtidas</span>
                        </div>
                    </div>

                    <!-- Botão de Assinatura -->
                    @if(!$isSubscriber && $plans->count() > 0)
                        <button onclick="openSubscriptionModal({{ json_encode($plans->first()) }})" 
                                class="bg-white text-gray-900 px-8 py-3 rounded-xl font-semibold hover:bg-gray-100 transition-colors shadow-lg">
                            Seguir
                        </button>
                    @elseif($isSubscriber)
                        <button class="bg-white/20 text-white px-8 py-3 rounded-xl font-semibold border border-white/30">
                            Seguindo
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Container principal -->
    <div class="max-w-4xl mx-auto bg-white">
        <!-- Bio e Redes Sociais -->
        <div class="p-6 border-b border-gray-200">
            @if($creator->bio)
                <p class="text-gray-800 mb-4">{{ $creator->bio }}</p>
            @endif

            @if($creator->twitter_url || $creator->tiktok_url || $creator->instagram_url)
                <div class="flex items-center space-x-4">
                    @if($creator->instagram_url)
                        <a href="{{ $creator->instagram_url }}" target="_blank" class="text-gray-600 hover:text-pink-500 transition-colors">
                            <i data-lucide="instagram" class="w-6 h-6"></i>
                        </a>
                    @endif
                    @if($creator->twitter_url)
                        <a href="{{ $creator->twitter_url }}" target="_blank" class="text-gray-600 hover:text-blue-500 transition-colors">
                            <i data-lucide="twitter" class="w-6 h-6"></i>
                        </a>
                    @endif
                    @if($creator->tiktok_url)
                        <a href="{{ $creator->tiktok_url }}" target="_blank" class="text-gray-600 hover:text-black transition-colors">
                            <i data-lucide="music" class="w-6 h-6"></i>
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <!-- Seção de Planos restaurada -->
        @if($plans->count() > 0)
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Planos de Assinatura</h2>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach($plans as $plan)
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100 hover:shadow-lg transition-shadow">
                    <div class="text-center">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $plan->name }}</h3>

                        <div class="text-3xl font-bold text-purple-600 mb-1">
                            R$ {{ $plan->formatted_priceT }}
                        </div>

                        <p class="text-sm text-gray-600 mb-4">por {{ $plan->period }}</p>
                        
                        @if($plan->description)
                            <p class="text-sm text-gray-700 mb-4">{{ $plan->description }}</p>
                        @endif

                        @if($plan->discount_percentage > 0)
                            <div class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded-full mb-4 inline-block">
                                {{ $plan->discount_percentage }}% OFF
                            </div>
                        @endif

                        <button id="buyButton" data-hash="{{ $plan->hash_id }}" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-colors">
                            Assinar
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif


        <!-- Feed de Posts Estilo Instagram -->
        <div class="pb-4">
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
                                        <!-- Using featured_image_url accessor instead of image field -->
                                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                    @else
                                        <!-- Conteúdo embaçado para não-assinantes -->
                                        <!-- Using featured_image_url accessor for blurred content -->
                                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover filter blur-lg scale-110">
                                        
                                        <!-- Overlay with call-to-action -->
                                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                            <div class="text-center text-white">
                                                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                                                    <i data-lucide="lock" class="w-8 h-8"></i>
                                                </div>
                                                <p class="font-semibold mb-2">Conteúdo Exclusivo</p>
                                                <p class="text-sm opacity-90 mb-4">Assine para ver</p>
                                                @if($plans->count() > 0)
                                                    <button onclick="openSubscriptionModal({{ json_encode($plans->first()) }})" 
                                                            class="bg-white text-black px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors">
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
                                        <button onclick="toggleLike({{ $post->id }})" class="hover:text-red-500 transition-colors">
                                            <i data-lucide="heart" class="w-6 h-6"></i>
                                        </button>
                                        <button class="hover:text-blue-500 transition-colors">
                                            <i data-lucide="message-circle" class="w-6 h-6"></i>
                                        </button>
                                        <button class="hover:text-green-500 transition-colors">
                                            <i data-lucide="send" class="w-6 h-6"></i>
                                        </button>
                                    @else
                                        <div class="flex items-center space-x-4 opacity-50">
                                            <i data-lucide="heart" class="w-6 h-6"></i>
                                            <i data-lucide="message-circle" class="w-6 h-6"></i>
                                            <i data-lucide="send" class="w-6 h-6"></i>
                                        </div>
                                    @endif
                                </div>
                                <button class="hover:text-gray-700 transition-colors">
                                    <i data-lucide="bookmark" class="w-6 h-6"></i>
                                </button>
                            </div>

                            <!-- Curtidas -->
                            @if(!$post->is_private || $isSubscriber)
                                <p class="font-semibold text-sm mb-2">{{ $post->likes_count ?? 0 }} curtidas</p>
                            @endif

                            <!-- Conteúdo do Post -->
                            <div class="text-sm">
                                <span class="font-semibold">{{ $creator->display_name }}</span>
                                @if(!$post->is_private || $isSubscriber)
                                    <span class="ml-2">{{ $post->content }}</span>
                                @else
                                    <span class="ml-2 text-gray-500 italic">Conteúdo disponível apenas para assinantes</span>
                                @endif
                            </div>

                            <!-- Hashtags -->
                            @if((!$post->is_private || $isSubscriber) && $post->tags)
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
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Paginação -->
                @if($posts->hasPages())
                    <div class="p-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <!-- Estado vazio -->
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i data-lucide="image" class="w-8 h-8 text-gray-400"></i>
                    </div>
                    <h3 class="font-medium text-gray-900 mb-2">Nenhuma postagem ainda</h3>
                    <p class="text-gray-500 text-sm">{{ $creator->display_name }} ainda não publicou nenhum conteúdo.</p>
                </div>
            @endif
        </div>

        <!-- CTA para Não-Assinantes -->
        @if(!$isSubscriber && $creator->totalPrivatePosts() > 0)
            <div class="p-4 border-t border-gray-200">
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i data-lucide="lock" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Desbloqueie Todo o Conteúdo</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $creator->display_name }} tem {{ $creator->totalPrivatePosts() }} postagens exclusivas esperando por você</p>
                    
                    @if($plans->count() > 0)
                        <button onclick="openSubscriptionModal({{ json_encode($plans->first()) }})" 
                                class="bg-black text-white px-6 py-3 rounded-xl font-medium hover:bg-gray-800 transition-colors">
                            Assinar por R$ {{ $plans->first()->formatted_price }}
                        </button>
                    @endif
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
