@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 dark:from-gray-900 dark:via-purple-900/20 dark:to-pink-900/20 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('associacao.raffles.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 mb-2">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
                        Voltar para Rifas
                    </a>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        Tickets da Rifa
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $raffle->title }}</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total de Tickets</p>
                        {{-- Using $stats array from controller --}}
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($stats['total'], 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="ticket" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Vendidos</p>
                        {{-- Using $stats array from controller --}}
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-1">{{ number_format($stats['sold'], 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Disponíveis</p>
                        {{-- Using $stats array from controller --}}
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">{{ number_format($stats['available'], 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="circle-dot" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Progresso</p>
                        {{-- Calculating percentage from stats --}}
                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400 mt-1">
                            {{ $stats['total'] > 0 ? number_format(($stats['sold'] / $stats['total']) * 100, 1) : 0 }}%
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="trending-up" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 mb-8" x-data="{ filter: 'all' }">
            <div class="flex flex-wrap gap-3">
                <button @click="filter = 'all'" 
                        :class="filter === 'all' ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                        class="px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:shadow-lg">
                    <i data-lucide="list" class="w-4 h-4 inline mr-2"></i>
                    {{-- Using $stats array from controller --}}
                    Todos ({{ number_format($stats['total'], 0, ',', '.') }})
                </button>
                <button @click="filter = 'available'" 
                        :class="filter === 'available' ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                        class="px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:shadow-lg">
                    <i data-lucide="circle-dot" class="w-4 h-4 inline mr-2"></i>
                    {{-- Using $stats array from controller --}}
                    Disponíveis ({{ number_format($stats['available'], 0, ',', '.') }})
                </button>
                <button @click="filter = 'sold'" 
                        :class="filter === 'sold' ? 'bg-gradient-to-r from-green-600 to-emerald-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                        class="px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:shadow-lg">
                    <i data-lucide="check-circle" class="w-4 h-4 inline mr-2"></i>
                    {{-- Using $stats array from controller --}}
                    Vendidos ({{ number_format($stats['sold'], 0, ',', '.') }})
                </button>
            </div>

            <!-- Tickets Grid -->
            <div class="mt-6 grid grid-cols-5 sm:grid-cols-10 md:grid-cols-15 lg:grid-cols-20 gap-2">
                @foreach($tickets as $ticket)
                <div x-show="filter === 'all' || (filter === 'available' && '{{ $ticket->status }}' === 'available') || (filter === 'sold' && '{{ $ticket->status }}' === 'sold')"
                     x-transition
                     class="relative group">
                    <div class="aspect-square rounded-lg flex items-center justify-center text-sm font-bold transition-all duration-200 cursor-pointer
                                {{ $ticket->status === 'sold' 
                                    ? 'bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-lg' 
                                    : 'bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 text-gray-700 dark:text-gray-300 hover:shadow-lg hover:scale-105' }}"
                         @if($ticket->status === 'sold' && $ticket->raffleSale)
                         x-data="{ showTooltip: false }"
                         @mouseenter="showTooltip = true"
                         @mouseleave="showTooltip = false"
                         @endif>
                        {{ str_pad($ticket->number, 4, '0', STR_PAD_LEFT) }}
                        
                        @if($ticket->status === 'sold')
                        <div class="absolute top-0 right-0 w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </div>

                    @if($ticket->status === 'sold' && $ticket->raffleSale)
                    <!-- Tooltip -->
                    <div x-show="showTooltip"
                         x-transition
                         class="absolute z-50 bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded-lg shadow-xl whitespace-nowrap pointer-events-none">
                        <div class="font-semibold">{{ $ticket->raffleSale->buyer_name }}</div>
                        <div class="text-gray-300">{{ $ticket->raffleSale->buyer_email }}</div>
                        <div class="text-gray-400 text-xs mt-1">{{ $ticket->raffleSale->created_at->format('d/m/Y H:i') }}</div>
                        <div class="absolute top-full left-1/2 transform -translate-x-1/2 -mt-1">
                            <div class="border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- Added pagination links --}}
            @if($tickets->hasPages())
            <div class="mt-6">
                {{ $tickets->links() }}
            </div>
            @endif
        </div>

        <!-- Recent Sales -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i data-lucide="shopping-cart" class="w-5 h-5 mr-2 text-purple-600"></i>
                    Vendas Recentes
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Comprador</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Quantidade</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Data</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Números</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($raffle->sales()->with('tickets')->latest()->limit(20)->get() as $sale)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900 dark:text-white">
                                #{{ substr($sale->id, 0, 8) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $sale->buyer_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                {{ $sale->buyer_email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 rounded-full font-medium">
                                    {{ $sale->quantity }} tickets
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600 dark:text-green-400">
                                R$ {{ number_format($sale->total_price, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                {{ $sale->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($sale->tickets->take(5) as $ticket)
                                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs font-mono">
                                        {{ str_pad($ticket->number, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                    @endforeach
                                    @if($sale->tickets->count() > 5)
                                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs">
                                        +{{ $sale->tickets->count() - 5 }}
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
                                <p>Nenhuma venda realizada ainda</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
@endsection
