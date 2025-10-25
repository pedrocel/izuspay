@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 dark:from-gray-900 dark:via-purple-900/20 dark:to-pink-900/20 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400 bg-clip-text text-transparent">
                        Vendas de Rifas
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Gerencie todas as vendas realizadas
                    </p>
                </div>
                <a href="{{ route('associacao.raffles.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Voltar
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
        @endif

        <!-- Sales Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-purple-500 to-pink-500">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Rifa
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Comprador
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Quantidade
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Total
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Data
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($sales as $sale)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                #{{ substr($sale->id, 0, 8) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $sale->raffle->title }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $sale->buyer_name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $sale->buyer_email }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $sale->quantity }} ticket(s)
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-100">
                                R$ {{ number_format($sale->total_price, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($sale->payment_status === 'paid')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                        Pago
                                    </span>
                                @elseif($sale->payment_status === 'pending')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                                        Pendente
                                    </span>
                                @elseif($sale->payment_status === 'failed')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                        Falhou
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                        {{ ucfirst($sale->payment_status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $sale->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button @click="showTickets = true; selectedSale = {{ $sale->id }}" 
                                        class="text-purple-600 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 font-medium">
                                    Ver Números
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg">
                                        Nenhuma venda encontrada
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($sales->hasPages())
            <div class="bg-gray-50 dark:bg-gray-900/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $sales->links() }}
            </div>
            @endif
        </div>

        <!-- Modal para ver números -->
        <div x-data="{ showTickets: false, selectedSale: null }" 
             x-show="showTickets" 
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div x-show="showTickets"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="showTickets = false"
                     class="fixed inset-0 transition-opacity bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <!-- Modal panel -->
                <div x-show="showTickets"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">
                            Números da Venda
                        </h3>
                    </div>

                    <div class="px-6 py-4">
                        <template x-for="sale in {{ $sales->toJson() }}" :key="sale.id">
                            <div x-show="selectedSale === sale.id">
                                <div class="grid grid-cols-5 gap-2">
                                    <template x-for="ticket in sale.tickets" :key="ticket.id">
                                        <div class="bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-lg p-3 text-center border-2 border-purple-300 dark:border-purple-700">
                                            <span class="text-lg font-bold text-purple-700 dark:text-purple-300" x-text="ticket.number"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900/50 px-6 py-4 flex justify-end">
                        <button @click="showTickets = false" 
                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
