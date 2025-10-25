<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Números - Rifas Online</title>
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
                    <a href="{{ route('public.raffles.winners') }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 font-medium transition">Ganhadores</a>
                    <a href="{{ route('public.raffles.my-numbers') }}" class="text-purple-600 dark:text-purple-400 font-bold">Meus Números</a>
                </nav>

                <a href="{{ route('login') }}" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition font-medium">
                    Admin
                </a>
            </div>
        </div>
    </header>

    <!-- My Numbers Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-black mb-4 bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    MEUS NÚMEROS
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    Consulte seus números da sorte
                </p>
            </div>

            <!-- Search Form -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl mb-8">
                <form action="{{ route('public.raffles.my-numbers') }}" method="GET">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        Digite seu e-mail para consultar suas compras:
                    </label>
                    <div class="flex gap-4">
                        <input type="email" name="email" value="{{ $email }}" required
                               placeholder="seu@email.com"
                               class="flex-1 px-4 py-3 border-2 border-purple-300 dark:border-purple-700 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:border-purple-600 focus:ring-2 focus:ring-purple-600">
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-lg hover:from-purple-700 hover:to-pink-700 transition">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Results -->
            @if($email)
                @if($sales->isEmpty())
                    <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-2xl shadow-xl">
                        <svg class="w-24 h-24 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-xl text-gray-600 dark:text-gray-400">Nenhuma compra encontrada para este e-mail.</p>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($sales as $sale)
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-xl">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">
                                            {{ $sale->raffle->title }}
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400">
                                            Comprado em {{ $sale->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total pago</p>
                                        <p class="text-2xl font-black text-purple-600 dark:text-purple-400">
                                            R$ {{ number_format($sale->total_price, 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div class="mb-4">
                                    @if($sale->payment_status === 'paid')
                                        <span class="px-4 py-2 bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 font-bold rounded-full text-sm">
                                            ✓ Pagamento Confirmado
                                        </span>
                                    @elseif($sale->payment_status === 'pending')
                                        <span class="px-4 py-2 bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 font-bold rounded-full text-sm">
                                            ⏳ Aguardando Pagamento
                                        </span>
                                    @else
                                        <span class="px-4 py-2 bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 font-bold rounded-full text-sm">
                                            ✗ {{ ucfirst($sale->payment_status) }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Numbers -->
                                <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 p-6 rounded-xl border-2 border-purple-200 dark:border-purple-700">
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                                        Seus números da sorte ({{ $sale->quantity }} bilhetes):
                                    </p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($sale->tickets as $ticket)
                                            <span class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-black rounded-lg text-lg">
                                                {{ str_pad($ticket->number, 4, '0', STR_PAD_LEFT) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
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
