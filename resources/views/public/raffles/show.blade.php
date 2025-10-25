<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $raffle->title }} - Rifas Online</title>
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

    <!-- Raffle Details Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <!-- Image -->
                <div class="rounded-2xl overflow-hidden shadow-2xl">
                    <img src="{{ $raffle->image ? asset('storage/' . $raffle->image) : 'https://via.placeholder.com/600x400' }}" 
                         alt="{{ $raffle->title }}" 
                         class="w-full h-full object-cover">
                </div>

                <!-- Info -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl">
                    <div class="inline-block px-4 py-2 bg-green-500 text-white font-bold rounded-full text-sm mb-4">
                        ATIVA
                    </div>
                    <h1 class="text-4xl font-black mb-4 text-gray-800 dark:text-white">{{ $raffle->title }}</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-lg">{{ $raffle->description }}</p>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 p-4 rounded-xl border-2 border-purple-200 dark:border-purple-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Valor por bilhete</p>
                            <p class="text-3xl font-black text-purple-600 dark:text-purple-400">
                                R$ {{ number_format($raffle->price, 2, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-gradient-to-br from-pink-50 to-orange-50 dark:from-pink-900/30 dark:to-orange-900/30 p-4 rounded-xl border-2 border-pink-200 dark:border-pink-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Disponíveis</p>
                            <p class="text-3xl font-black text-pink-600 dark:text-pink-400">
                                {{ $availableCount }} / {{ $raffle->total_tickets }}
                            </p>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-6">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Progresso de Vendas</span>
                            <span class="font-bold text-purple-600 dark:text-purple-400">
                                {{ number_format($soldPercentage, 1) }}% vendidos
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-purple-600 to-pink-600 rounded-full transition-all duration-500" 
                                 style="width: {{ $soldPercentage }}%">
                            </div>
                        </div>
                    </div>

                    @if($raffle->draw_date)
                    <div class="bg-orange-50 dark:bg-orange-900/30 p-4 rounded-xl border-2 border-orange-200 dark:border-orange-700 mb-6">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Data do Sorteio</p>
                        <p class="text-xl font-bold text-orange-600 dark:text-orange-400">
                            {{ $raffle->draw_date->format('d/m/Y') }}
                        </p>
                    </div>
                    @endif

                    <a href="{{ route('public.raffles.checkout', $raffle->hash_id) }}" class="block w-full py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white text-center text-xl font-black rounded-xl hover:from-purple-700 hover:to-pink-700 transition transform hover:scale-105 shadow-xl">
                        🎫 COMPRAR AGORA
                    </a>
                </div>
            </div>

            <!-- Info Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl">
                <h2 class="text-3xl font-black mb-6 text-gray-800 dark:text-white">Como Participar</h2>
                
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">1️⃣</span>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800 dark:text-white">Escolha a Quantidade</h3>
                        <p class="text-gray-600 dark:text-gray-400">Selecione quantos bilhetes você quer comprar</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-pink-100 dark:bg-pink-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">2️⃣</span>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800 dark:text-white">Pague com PIX</h3>
                        <p class="text-gray-600 dark:text-gray-400">Pagamento rápido e seguro via PIX</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">3️⃣</span>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800 dark:text-white">Receba seus Números</h3>
                        <p class="text-gray-600 dark:text-gray-400">Seus números da sorte são reservados automaticamente</p>
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
