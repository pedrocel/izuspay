<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganhadores - Rifas Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    <a href="{{ route('public.raffles.winners') }}" class="text-purple-600 dark:text-purple-400 font-bold">Ganhadores</a>
                    <a href="{{ route('public.raffles.my-numbers') }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 font-medium transition">Meus Números</a>
                </nav>

                <a href="{{ route('login') }}" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition font-medium">
                    Admin
                </a>
            </div>
        </div>
    </header>

    <!-- Winners Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="text-center mb-12">
                <div class="inline-block p-4 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full mb-4">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                    </svg>
                </div>
                <h1 class="text-5xl font-black mb-4 bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    GANHADORES
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    Confira os sortudos que já ganharam prêmios incríveis!
                </p>
            </div>

            @if($winners->isEmpty())
                <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-2xl shadow-xl">
                    <svg class="w-24 h-24 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xl text-gray-600 dark:text-gray-400">Nenhum ganhador ainda.</p>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($winners as $winner)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition">
                            <div class="md:flex">
                                <!-- Image -->
                                <div class="md:w-1/3 h-64 md:h-auto">
                                    <img src="{{ $winner->image ?: 'https://via.placeholder.com/400x300' }}" 
                                         alt="{{ $winner->title }}" 
                                         class="w-full h-full object-cover">
                                </div>

                                <!-- Content -->
                                <div class="md:w-2/3 p-8">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-3xl font-black text-gray-800 dark:text-white mb-2">
                                                {{ $winner->title }}
                                            </h3>
                                            <p class="text-gray-600 dark:text-gray-400">
                                                Sorteado em {{ $winner->draw_date->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="px-4 py-2 bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-bold rounded-full">
                                            🏆 FINALIZADO
                                        </div>
                                    </div>

                                    @if($winner->winnerSale)
                                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 p-6 rounded-xl border-2 border-purple-200 dark:border-purple-700">
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Ganhador(a):</p>
                                            <p class="text-2xl font-black text-purple-600 dark:text-purple-400 mb-4">
                                                {{ $winner->winnerSale->buyer_name }}
                                            </p>
                                            
                                            <div class="flex flex-wrap gap-2">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">Números sorteados:</span>
                                                @foreach($winner->winnerSale->tickets as $ticket)
                                                    <span class="px-3 py-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-lg">
                                                        {{ str_pad($ticket->number, 4, '0', STR_PAD_LEFT) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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
