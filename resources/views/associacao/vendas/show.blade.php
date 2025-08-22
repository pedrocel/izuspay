@extends('layouts.app')

@section('title', 'Venda #{{ $sale->id }} - AssociaMe')
@section('page-title', 'Detalhes da Venda')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="shopping-cart" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Venda #{{ $sale->id }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">Detalhes completos da venda realizada em {{ $sale->created_at->format('d/m/Y') }}.</p>
                </div>
            </div>
            <a href="{{ route('associacao.vendas.index') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="shopping-bag" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informações da Venda</h3>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-600 dark:text-gray-400">
                    <div class="space-y-2">
                        <p><span class="font-medium text-gray-900 dark:text-white">Status:</span> {!! $sale->getStatusBadge() !!}</p>
                        <p><span class="font-medium text-gray-900 dark:text-white">Valor:</span> <span class="font-bold text-green-600">R$ {{ number_format($sale->total_price, 2, ',', '.') }}</span></p>
                        <p><span class="font-medium text-gray-900 dark:text-white">Método de Pagamento:</span> <span class="font-semibold">{{ ucfirst($sale->payment_method) }}</span></p>
                        <p><span class="font-medium text-gray-900 dark:text-white">Realizada em:</span> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @if($sale->payment_method === 'pix')
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Detalhes do Pix</h4>
                            <div class="flex items-center space-x-2 text-sm">
                                <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
                                <span>Código Pix gerado com sucesso.</span>
                            </div>
                            <p class="text-xs mt-2">Instruções de pagamento enviadas por e-mail para o cliente.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="repeat" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Histórico de Transações</h3>
                    </div>
                </div>
                <div class="p-6">
                    <ul class="space-y-4">
                        @forelse($sale->transactions as $transaction)
                        <li class="flex items-start space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex-shrink-0 flex items-center justify-center">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    Pagamento via {{ ucfirst($transaction->payment_method) }}
                                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full {{ $transaction->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $transaction->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div class="text-sm font-bold text-gray-900 dark:text-white">
                                R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                            </div>
                        </li>
                        @empty
                        <li class="py-4 text-center text-gray-500 dark:text-gray-400">
                            Nenhuma transação registrada.
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3 mb-4">
                    <i data-lucide="user" class="w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cliente</h3>
                </div>
                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                    <li class="flex justify-between items-center">
                        <span class="font-medium">Nome:</span>
                        <span>{{ $sale->user->name }}</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="font-medium">Email:</span>
                        <span>{{ $sale->user->email }}</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="font-medium">Documento:</span>
                        <span>{{ $sale->user->documento_formatado ?? 'N/A' }}</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="font-medium">Telefone:</span>
                        <span>{{ $sale->user->telefone_formatado ?? 'N/A' }}</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3 mb-4">
                    <i data-lucide="award" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Plano Adquirido</h3>
                </div>
                <div class="space-y-2 text-gray-600 dark:text-gray-400">
                    <p class="flex justify-between items-center"><span class="font-medium">Nome:</span> <span>{{ $sale->plan->name }}</span></p>
                    <p class="flex justify-between items-center"><span class="font-medium">Recorrência:</span> <span>{{ ucfirst($sale->plan->recurrence) }}</span></p>
                    <p class="flex justify-between items-center"><span class="font-medium">Valor Base:</span> <span>R$ {{ number_format($sale->plan->total_price, 2, ',', '.') }}</span></p>
                    
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3">
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Produtos do Plano:</h4>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($sale->plan->products as $product)
                                <li>{{ $product->name }} (R$ {{ number_format($product->price, 2, ',', '.') }})</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ações da Venda</h3>
                <div class="space-y-2">
                    <a href="{{ route('associacao.vendas.edit', $sale) }}" 
                       class="inline-flex items-center w-full justify-center space-x-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i data-lucide="edit" class="w-4 h-4"></i>
                        <span>Editar Venda</span>
                    </a>
                    <button onclick="confirmDelete('{{ $sale->id }}', 'Venda #{{ $sale->id }}')" 
                            class="inline-flex items-center w-full justify-center space-x-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        <span>Excluir Venda</span>
                    </button>
                    <div class="flex space-x-4">
             @if($sale->status === 'awaiting_payment')
                    <form action="{{ route('associacao.vendas.update-status', $sale) }}" method="POST" class="inline-block w-full mt-2">
                        @csrf
                        @method('PATCH') {{-- CORRIGIDO AQUI --}}
                        <input type="hidden" name="status" value="paid">
                        <button type="submit" class="inline-flex items-center w-full justify-center space-x-2 px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg font-medium transition-colors">
                            <i data-lucide="check" class="w-4 h-4"></i>
                            <span>Marcar como Pago e Ativar Assinatura</span>
                        </button>
                    </form>
                @endif
            </div>
                </div>
            </div>
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