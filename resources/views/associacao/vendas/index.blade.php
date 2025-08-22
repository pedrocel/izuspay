@extends('layouts.app')

@section('title', 'Vendas - AssociaMe')
@section('page-title', 'Gerenciar Vendas')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <i data-lucide="shopping-cart" class="w-6 h-6 text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Vendas</h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Gerencie todas as vendas realizadas na sua associação.</p>
            </div>
            <a href="{{ route('associacao.vendas.create') }}" 
               class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Nova Venda</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total de Vendas</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $sales->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="shopping-bag" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Receita Total</p>
                    <p class="text-2xl font-bold text-green-600">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="wallet" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Vendas Pendentes</p>
                    <p class="text-2xl font-bold text-yellow-600">R$ {{ number_format($pendingRevenue, 2, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="clock" class="w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Vendas Canceladas</p>
                    <p class="text-2xl font-bold text-red-600">{{ $cancelledSales }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="x-circle" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Lista de Vendas</h3>
            <button onclick="openFilterModal()" class="text-gray-600 dark:text-gray-400 hover:text-green-600 transition-colors">
                <i data-lucide="filter" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Cliente
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Plano
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Valor
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Método
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Data
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($sales as $sale)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">#{{ $sale->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $sale->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $sale->plan->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-green-600">R$ {{ number_format($sale->total_price, 2, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {!! $sale->getStatusBadge() !!}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            @php
                                $icon = '';
                                switch ($sale->payment_method) {
                                    case 'pix':
                                        $icon = asset('img/pix.png');
                                        break;
                                    case 'credit_card':
                                        $icon = asset('img/cartao.png');
                                        break;
                                    case 'boleto':
                                        $icon = asset('img/boleto.png');
                                        break;
                                }
                            @endphp
                            @if($icon)
                                <img src="{{ $icon }}" alt="{{ ucfirst($sale->payment_method) }}" title="{{ ucfirst($sale->payment_method) }}" class="w-6 h-auto">
                            @else
                                {{ ucfirst($sale->payment_method) }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $sale->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('associacao.vendas.show', $sale) }}" 
                                   class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </a>
                                <a href="{{ route('associacao.vendas.edit', $sale) }}" 
                                   class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                </a>
                                <button onclick="confirmDelete('{{ $sale->id }}', 'Venda #{{ $sale->id }}')"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                                    <form action="{{ route('associacao.vendas.update-status', $sale) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH') {{-- CORRIGIDO AQUI --}}
                                        <input type="hidden" name="status" value="paid">
                                        <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" title="Marcar como Pago e Ativar Assinatura">
                                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            Nenhuma venda encontrada.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($sales->hasPages())
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        {{ $sales->links() }}
    </div>
    @endif
</div>

<div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl max-w-lg w-full p-6 transform transition-all">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Filtros de Vendas</h3>
                <button onclick="closeFilterModal()" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <form method="GET" action="{{ route('associacao.vendas.index') }}" class="space-y-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select id="status" name="status" class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        <option value="">Todos</option>
                        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Pago</option>
                        <option value="awaiting_payment" {{ request('status') === 'awaiting_payment' ? 'selected' : '' }}>Pendente</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Método de Pagamento</label>
                    <select id="payment_method" name="payment_method" class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        <option value="">Todos</option>
                        <option value="credit_card" {{ request('payment_method') === 'credit_card' ? 'selected' : '' }}>Cartão de Crédito</option>
                        <option value="pix" {{ request('payment_method') === 'pix' ? 'selected' : '' }}>Pix</option>
                        <option value="boleto" {{ request('payment_method') === 'boleto' ? 'selected' : '' }}>Boleto</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="from_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data Inicial</label>
                        <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="to_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data Final</label>
                        <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Aplicar
                    </button>
                    <a href="{{ route('associacao.vendas.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Limpar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl max-w-md w-full p-6 transform transition-all">
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 dark:bg-red-900/20 rounded-full">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
            </div>
            
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">Confirmar Exclusão</h3>
            <p class="text-gray-600 dark:text-gray-400 text-center mb-6">
                Tem certeza que deseja excluir a <span id="deleteSaleName" class="font-medium"></span>? 
                Esta ação não pode ser desfeita.
            </p>
            
            <div class="flex space-x-4">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openFilterModal() {
        document.getElementById('filterModal').classList.remove('hidden');
    }

    function closeFilterModal() {
        document.getElementById('filterModal').classList.add('hidden');
    }
    
    function confirmDelete(saleId, saleName) {
        document.getElementById('deleteSaleName').textContent = saleName;
        document.getElementById('deleteForm').action = `{{ route('associacao.vendas.destroy', '') }}/${saleId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection