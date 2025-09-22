@extends('layouts.app')

@section('title', 'Vendas - Izus Payment')
@section('page-title', 'Gerenciar Vendas')

@section('content')
<div class="space-y-8">
    {{-- CABEÇALHO PRINCIPAL --}}
    <div class="relative rounded-2xl p-8 overflow-hidden bg-slate-900 border border-blue-500/20 shadow-2xl">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-black to-black opacity-80"></div>
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full opacity-20 blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-4 mb-2">
                    <div class="w-16 h-16 bg-black/30 backdrop-blur-sm border border-white/10 rounded-xl flex items-center justify-center shadow-lg">
                        <i data-lucide="shopping-cart" class="w-8 h-8 text-blue-300"></i>
                    </div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                        Gerenciar Vendas
                    </h1>
                </div>
            </div>
            {{-- <div class="flex items-center gap-3 self-start sm:self-center">
                <a href="{{ route('associacao.vendas.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-500 to-cyan-600 hover:from-blue-600 hover:to-cyan-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span>Nova Venda</span>
                </a>
            </div> --}}
        </div>
    </div>

    {{-- CARDS DE MÉTRICAS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $metrics = [
                ['title' => 'Total de Vendas', 'value' => $sales->total(), 'icon' => 'shopping-bag', 'color' => 'blue-cyan'],
                ['title' => 'Receita Aprovada', 'value' => 'R$ ' . number_format($totalRevenue, 2, ',', '.'), 'icon' => 'wallet', 'color' => 'green-emerald'],
                ['title' => 'Receita Pendente', 'value' => 'R$ ' . number_format($pendingRevenue, 2, ',', '.'), 'icon' => 'hourglass', 'color' => 'orange-amber'],
                ['title' => 'Vendas Canceladas', 'value' => $cancelledSales, 'icon' => 'x-circle', 'color' => 'red-rose'],
            ];
            $colors = [
                'blue-cyan' => ['from' => 'from-blue-500', 'to' => 'to-cyan-500', 'text' => 'text-blue-300'],
                'green-emerald' => ['from' => 'from-green-500', 'to' => 'to-emerald-500', 'text' => 'text-green-400'],
                'orange-amber' => ['from' => 'from-orange-500', 'to' => 'to-amber-500', 'text' => 'text-orange-400'],
                'red-rose' => ['from' => 'from-red-500', 'to' => 'to-rose-500', 'text' => 'text-red-400'],
            ];
        @endphp

        @foreach($metrics as $metric)
        <div class="relative bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl p-6 hover:-translate-y-1 transition-transform duration-300 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br {{ $colors[$metric['color']]['from'] }} {{ $colors[$metric['color']]['to'] }} opacity-10 blur-2xl"></div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium {{ $colors[$metric['color']]['text'] }} mb-1">{{ $metric['title'] }}</p>
                    <p class="text-3xl font-bold text-white">{{ $metric['value'] }}</p>
                </div>
                <div class="w-14 h-14 bg-black/20 border border-white/10 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="{{ $metric['icon'] }}" class="w-7 h-7 {{ $colors[$metric['color']]['text'] }}"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- TABELA DE VENDAS --}}
    <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-white">Histórico de Vendas</h3>
            <button onclick="openFilterModal()" class="flex items-center space-x-2 text-gray-300 hover:text-white bg-slate-700/50 hover:bg-slate-700 px-4 py-2 rounded-lg transition-colors">
                <i data-lucide="filter" class="w-4 h-4"></i>
                <span>Filtros</span>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-black/20">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Cliente</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Origem</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Valor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Método</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Data</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($sales as $sale)
                    <tr class="hover:bg-blue-900/20 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $sale->id}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $sale->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            @if($sale->plan_id && $sale->plan) <i data-lucide="layers" class="w-4 h-4 inline-block mr-1.5 text-blue-400"></i> {{ $sale->plan->name }}
                            @elseif($sale->product_id && $sale->product) <i data-lucide="package" class="w-4 h-4 inline-block mr-1.5 text-cyan-400"></i> {{ $sale->product->name }}
                            @else <span class="text-gray-500">N/A</span> @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-400">R$ {{ number_format($sale->total_price, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{!! $sale->getStatusBadge() !!}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @php
                                $methodMap = [
                                    'pix' => ['icon' => 'img/icons/pix.png', 'title' => 'PIX'],
                                    'credit_card' => ['icon' => 'img/icons/credit-card.png', 'title' => 'Cartão de Crédito'],
                                    'boleto' => ['icon' => 'img/icons/boleto.png', 'title' => 'Boleto'],
                                ];
                                $paymentInfo = $methodMap[$sale->payment_method] ?? null;
                            @endphp
                            @if($paymentInfo)
                                <img src="{{ asset($paymentInfo['icon']) }}" alt="{{ $paymentInfo['title'] }}" title="{{ $paymentInfo['title'] }}" class="w-7 h-auto inline-block">
                            @else
                                <span class="text-gray-400 text-xs">{{ ucfirst(str_replace('_', ' ', $sale->payment_method)) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                {{-- Botão de Aprovar (Aparece apenas se o status for pendente) --}}
                                @if($sale->status === 'awaiting_payment')
                                <form action="{{ route('associacao.vendas.update-status', $sale) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="paid">
                                    <button type="submit" class="p-2 text-green-400 hover:text-green-300 bg-green-900/30 hover:bg-green-900/60 rounded-md transition-colors" title="Aprovar Venda Manualmente">
                                        <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                                    </button>
                                </form>
                                @endif
                                
                                <a href="{{ route('associacao.vendas.show', $sale) }}" class="p-2 text-gray-400 hover:text-cyan-400 bg-slate-700/50 hover:bg-slate-700 rounded-md transition-colors" title="Ver Detalhes"><i data-lucide="eye" class="w-5 h-5"></i></a>
                                <a href="{{ route('associacao.vendas.edit', $sale) }}" class="p-2 text-gray-400 hover:text-blue-400 bg-slate-700/50 hover:bg-slate-700 rounded-md transition-colors" title="Editar"><i data-lucide="edit" class="w-5 h-5"></i></a>
                                <button onclick="confirmDelete('{{ $sale->id }}', 'Venda #{{ $sale->id }}')" class="p-2 text-gray-400 hover:text-red-400 bg-slate-700/50 hover:bg-slate-700 rounded-md transition-colors" title="Excluir"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <i data-lucide="search-x" class="w-10 h-10 mx-auto mb-3"></i>
                            Nenhuma venda encontrada com os filtros atuais.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($sales->hasPages())
        <div class="mt-8">{{ $sales->links() }}</div>
    @endif
</div>

{{-- MODAL DE FILTROS --}}
<div id="filterModal" class="fixed inset-0 bg-black/70 z-50 hidden backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-slate-800 rounded-2xl max-w-lg w-full p-8 shadow-2xl border border-blue-500/20">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white">Filtros de Vendas</h3>
                <button onclick="closeFilterModal()" class="text-gray-400 hover:text-white transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
            </div>
            <form method="GET" action="{{ route('associacao.vendas.index') }}" class="space-y-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                    <select id="status" name="status" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Todos</option>
                        <option value="paid" @selected(request('status') == 'paid')>Pago</option>
                        <option value="awaiting_payment" @selected(request('status') == 'awaiting_payment')>Pendente</option>
                        <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelado</option>
                    </select>
                </div>
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-300 mb-1">Método de Pagamento</label>
                    <select id="payment_method" name="payment_method" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Todos</option>
                        <option value="credit_card" @selected(request('payment_method') == 'credit_card')>Cartão de Crédito</option>
                        <option value="pix" @selected(request('payment_method') == 'pix')>PIX</option>
                        <option value="boleto" @selected(request('payment_method') == 'boleto')>Boleto</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="from_date" class="block text-sm font-medium text-gray-300 mb-1">De</label>
                        <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="to_date" class="block text-sm font-medium text-gray-300 mb-1">Até</label>
                        <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('associacao.vendas.index') }}" class="px-6 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors font-semibold">Limpar</a>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-lg hover:from-blue-600 hover:to-cyan-700 transition-colors font-semibold">Aplicar Filtros</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL DE EXCLUSÃO --}}
<div id="deleteModal" class="fixed inset-0 bg-black/70 z-50 hidden backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-slate-900 rounded-2xl max-w-md w-full p-8 shadow-2xl border border-red-500/30">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i data-lucide="alert-triangle" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-white">Confirmar Exclusão</h3>
                <p class="text-gray-400 mt-2">Tem certeza que deseja excluir a <strong id="deleteSaleName" class="text-white"></strong>?</p>
            </div>
            <div class="bg-red-900/30 border border-red-500/50 rounded-lg p-3 text-center text-sm text-red-300 mb-6">Esta ação não pode ser desfeita.</div>
            <div class="flex space-x-4">
                <button onclick="closeDeleteModal()" class="flex-1 px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-xl font-medium transition-all">Cancelar</button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 text-white rounded-xl font-medium transition-all shadow-lg">Sim, Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openFilterModal() { document.getElementById('filterModal').classList.remove('hidden'); }
    function closeFilterModal() { document.getElementById('filterModal').classList.add('hidden'); }
    function confirmDelete(saleId, saleName) {
        document.getElementById('deleteSaleName').textContent = saleName;
        document.getElementById('deleteForm').action = `{{ url('associacao/vendas') }}/${saleId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    function closeDeleteModal() { document.getElementById('deleteModal').classList.add('hidden'); }
</script>
@endpush
@endsection



