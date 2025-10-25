<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifas Online - Concorra a Prêmios Incríveis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-purple-50 via-pink-50 to-orange-50 dark:from-gray-900 dark:via-purple-900 dark:to-pink-900">
    
    <!-- Header/Navigation -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-purple-200 dark:border-purple-800">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        RIFAS ONLINE
                    </h1>
                </div>
                
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('public.raffles.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 font-medium transition">Início</a>
                    <a href="{{ route('public.raffles.winners') }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 font-medium transition">Ganhadores</a>
                    <a href="{{ route('public.raffles.my-numbers') }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 font-medium transition">Meus Números</a>
                </nav>

                <a href="{{ route('login') }}" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition font-medium">
                    Admin
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative py-20 md:py-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-600/20 via-pink-600/20 to-orange-600/20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <h2 class="text-5xl md:text-7xl font-black mb-6 bg-gradient-to-r from-purple-600 via-pink-600 to-orange-600 bg-clip-text text-transparent animate-pulse">
                    CONCORRA A PRÊMIOS INCRÍVEIS!
                </h2>
                <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 mb-8">
                    Participe das nossas rifas e realize seus sonhos
                </p>
                <a href="#raffles" class="inline-block px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white text-lg font-bold rounded-full hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition shadow-2xl">
                    Ver Rifas Disponíveis
                </a>
            </div>
        </div>
    </section>

    <!-- How to Participate Section -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-black text-center mb-4">
                É <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">FÁCIL</span> PARTICIPAR!
            </h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-12 text-lg">
                É o melhor de tudo é poder <strong>concorrer a esse super prêmio</strong> com apenas algumas moedas!
            </p>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Step 1 -->
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 border-2 border-purple-200 dark:border-purple-700 hover:scale-105 transition transform">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full flex items-center justify-center text-4xl">
                        🎫
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Escolha o seu Título</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Você pode escolher quantos títulos quiser! Quanto mais selecionar, mais chances você tem de ganhar!
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-pink-50 to-orange-50 dark:from-pink-900/30 dark:to-orange-900/30 border-2 border-pink-200 dark:border-pink-700 hover:scale-105 transition transform">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-pink-600 to-orange-600 rounded-full flex items-center justify-center text-4xl">
                        💳
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Efetue o pagamento</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Fácil e seguro! E você pode pagar via pix!
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-orange-50 to-purple-50 dark:from-orange-900/30 dark:to-purple-900/30 border-2 border-orange-200 dark:border-orange-700 hover:scale-105 transition transform">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-orange-600 to-purple-600 rounded-full flex items-center justify-center text-4xl">
                        ✅
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Pronto!</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Agora é só aguardar participando! Você pode consultar o seu título em "Meus números"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- VIP Group Section -->
    <section class="py-20 bg-gradient-to-r from-green-500 to-emerald-600 text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between max-w-5xl mx-auto">
                <div class="text-center md:text-left mb-8 md:mb-0">
                    <h2 class="text-4xl md:text-5xl font-black mb-4">QUER MAIS CHANCES?</h2>
                    <h3 class="text-3xl md:text-4xl font-bold mb-6">ENTRE NO GRUPO VIP!</h3>
                    <a href="https://wa.me/5511999999999?text=Quero%20entrar%20no%20grupo%20VIP" target="_blank" class="inline-block px-8 py-4 bg-white text-green-600 text-lg font-bold rounded-full hover:bg-gray-100 transform hover:scale-105 transition shadow-2xl">
                        ENTRAR NO WHATSAPP
                    </a>
                </div>
                <div class="w-48 h-48 md:w-64 md:h-64">
                    <svg class="w-full h-full" viewBox="0 0 24 24" fill="white">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Active Raffles Section -->
    <section id="raffles" class="py-20 bg-gradient-to-br from-purple-50 via-pink-50 to-orange-50 dark:from-gray-900 dark:via-purple-900 dark:to-pink-900">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-black text-center mb-12 bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                Rifas em Andamento
            </h2>

            @if($raffles->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                    <p class="text-xl text-gray-600 dark:text-gray-400">Nenhuma rifa disponível no momento.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($raffles as $raffle)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                            <!-- Raffle Image -->
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $raffle->image ? asset('storage/' . $raffle->image) : 'https://via.placeholder.com/400x250' }}" 
                                     alt="{{ $raffle->title }}" 
                                     class="w-full h-full object-cover">
                                <div class="absolute top-4 right-4 px-4 py-2 bg-green-500 text-white font-bold rounded-full text-sm">
                                    ATIVA
                                </div>
                            </div>

                            <!-- Raffle Body -->
                            <div class="p-6">
                                <h3 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white">{{ $raffle->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                    {{ Str::limit($raffle->description, 120) }}
                                </p>

                                <!-- Info Grid -->
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="bg-purple-50 dark:bg-purple-900/30 p-3 rounded-lg">
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Valor por bilhete</p>
                                        <p class="text-lg font-bold text-purple-600 dark:text-purple-400">
                                            R$ {{ number_format($raffle->price, 2, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="bg-pink-50 dark:bg-pink-900/30 p-3 rounded-lg">
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Disponíveis</p>
                                        <p class="text-lg font-bold text-pink-600 dark:text-pink-400">
                                            {{ $raffle->availableTicketsCount() }} / {{ $raffle->total_tickets }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600 dark:text-gray-400">Progresso</span>
                                        <span class="font-bold text-purple-600 dark:text-purple-400">
                                            {{ number_format($raffle->soldPercentage(), 1) }}% vendidos
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-purple-600 to-pink-600 rounded-full transition-all duration-500" 
                                             style="width: {{ $raffle->soldPercentage() }}%">
                                        </div>
                                    </div>
                                </div>

                                <!-- CTA Button -->
                                <a href="{{ route('public.raffles.show', $raffle->hash_id) }}" 
                                   class="block w-full py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white text-center font-bold rounded-lg hover:from-purple-700 hover:to-pink-700 transition transform hover:scale-105">
                                    Participar Agora
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-white dark:bg-gray-800" x-data="{ openFaq: null }">
        <div class="container mx-auto px-4 max-w-4xl">
            <h2 class="text-4xl md:text-5xl font-black text-center mb-4">
                RIFAS ONLINE <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">É SEGURO</span>
            </h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-12 text-lg">
                Dúvida? Estamos aqui para ajudar.
            </p>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="border-2 border-purple-200 dark:border-purple-700 rounded-xl overflow-hidden">
                    <button @click="openFaq = openFaq === 1 ? null : 1" 
                            class="w-full px-6 py-4 flex items-center justify-between bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 hover:from-purple-100 hover:to-pink-100 dark:hover:from-purple-900/50 dark:hover:to-pink-900/50 transition">
                        <span class="font-bold text-lg text-gray-800 dark:text-white">QUEM PODE COMPRAR O BILHETE?</span>
                        <span class="text-2xl font-bold text-purple-600" x-text="openFaq === 1 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 1" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 py-4 bg-white dark:bg-gray-800">
                        <p class="text-gray-600 dark:text-gray-400">
                            Qualquer pessoa maior de 18 anos pode participar das nossas rifas. Basta escolher seus números e efetuar o pagamento de forma segura.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border-2 border-purple-200 dark:border-purple-700 rounded-xl overflow-hidden">
                    <button @click="openFaq = openFaq === 2 ? null : 2" 
                            class="w-full px-6 py-4 flex items-center justify-between bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 hover:from-purple-100 hover:to-pink-100 dark:hover:from-purple-900/50 dark:hover:to-pink-900/50 transition">
                        <span class="font-bold text-lg text-gray-800 dark:text-white">ESSE SORTEIO É LEGAL?</span>
                        <span class="text-2xl font-bold text-purple-600" x-text="openFaq === 2 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 2" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 py-4 bg-white dark:bg-gray-800">
                        <p class="text-gray-600 dark:text-gray-400">
                            Sim! Todos os nossos sorteios são realizados de acordo com a legislação vigente. Trabalhamos com total transparência e segurança.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border-2 border-purple-200 dark:border-purple-700 rounded-xl overflow-hidden">
                    <button @click="openFaq = openFaq === 3 ? null : 3" 
                            class="w-full px-6 py-4 flex items-center justify-between bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 hover:from-purple-100 hover:to-pink-100 dark:hover:from-purple-900/50 dark:hover:to-pink-900/50 transition">
                        <span class="font-bold text-lg text-gray-800 dark:text-white">SORTEIOS</span>
                        <span class="text-2xl font-bold text-purple-600" x-text="openFaq === 3 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 3" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 py-4 bg-white dark:bg-gray-800">
                        <p class="text-gray-600 dark:text-gray-400">
                            Os sorteios são realizados de forma transparente e todos os participantes são notificados. Você pode acompanhar os resultados na seção "Ganhadores".
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border-2 border-purple-200 dark:border-purple-700 rounded-xl overflow-hidden">
                    <button @click="openFaq = openFaq === 4 ? null : 4" 
                            class="w-full px-6 py-4 flex items-center justify-between bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 hover:from-purple-100 hover:to-pink-100 dark:hover:from-purple-900/50 dark:hover:to-pink-900/50 transition">
                        <span class="font-bold text-lg text-gray-800 dark:text-white">ONDE O PRÊMIO SERÁ ENTREGUE?</span>
                        <span class="text-2xl font-bold text-purple-600" x-text="openFaq === 4 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 4" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 py-4 bg-white dark:bg-gray-800">
                        <p class="text-gray-600 dark:text-gray-400">
                            O prêmio será entregue no endereço cadastrado pelo ganhador. Para prêmios em dinheiro, a transferência é feita via PIX de forma imediata.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-gradient-to-r from-purple-900 to-pink-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <p class="text-lg mb-2">&copy; {{ date('Y') }} Rifas Online. Todos os direitos reservados.</p>
            <p class="text-purple-200">Jogue com responsabilidade. Proibido para menores de 18 anos.</p>
        </div>
    </footer>

</body>
</html>
