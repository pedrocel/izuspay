@extends('layouts.app')

@section('title', isset($sale) ? 'Editar Venda - AssociaMe' : 'Nova Venda - AssociaMe')
@section('page-title', isset($sale) ? 'Editar Venda' : 'Nova Venda')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="{{ isset($sale) ? 'edit' : 'plus' }}" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ isset($sale) ? 'Editar Venda' : 'Nova Venda' }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ isset($sale) ? 'Atualize os detalhes da venda #'.$sale->id : 'Crie uma nova venda para um cliente' }}
                    </p>
                </div>
            </div>
            <a href="{{ route('associacao.vendas.index') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    <form action="{{ isset($sale) ? route('associacao.vendas.update', $sale) : route('associacao.vendas.store') }}" 
          method="POST" class="space-y-6">
        @csrf
        @if(isset($sale))
            @method('PUT')
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-2">
                    <i data-lucide="shopping-bag" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detalhes da Venda</h3>
                </div>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="user" class="w-4 h-4 inline mr-1"></i>
                        Cliente *
                    </label>
                    <select id="user_id" name="user_id" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('user_id') border-red-500 focus:ring-red-500 @enderror">
                        <option value="">Selecione um cliente</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $sale->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <div>
                    <label for="plan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="award" class="w-4 h-4 inline mr-1"></i>
                        Plano *
                    </label>
                    <select id="plan_id" name="plan_id" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('plan_id') border-red-500 focus:ring-red-500 @enderror">
                        <option value="">Selecione um plano</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" data-price="{{ $plan->total_price }}" {{ old('plan_id', $sale->plan_id ?? '') == $plan->id ? 'selected' : '' }}>
                                {{ $plan->name }} (R$ {{ number_format($plan->total_price, 2, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('plan_id')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <div>
                    <label for="total_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="dollar-sign" class="w-4 h-4 inline mr-1"></i>
                        Preço Total *
                    </label>
                    <input type="number" id="total_price" name="total_price" value="{{ old('total_price', $sale->total_price ?? '') }}" step="0.01" required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('total_price') border-red-500 focus:ring-red-500 @enderror"
                           placeholder="0.00">
                    @error('total_price')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="credit-card" class="w-4 h-4 inline mr-1"></i>
                        Método de Pagamento *
                    </label>
                    <select id="payment_method" name="payment_method" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('payment_method') border-red-500 focus:ring-red-500 @enderror">
                        <option value="">Selecione...</option>
                        <option value="credit_card" {{ old('payment_method', $sale->payment_method ?? '') == 'credit_card' ? 'selected' : '' }}>Cartão de Crédito</option>
                        <option value="pix" {{ old('payment_method', $sale->payment_method ?? '') == 'pix' ? 'selected' : '' }}>Pix</option>
                        <option value="boleto" {{ old('payment_method', $sale->payment_method ?? '') == 'boleto' ? 'selected' : '' }}>Boleto</option>
                    </select>
                    @error('payment_method')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="check-circle" class="w-4 h-4 inline mr-1"></i>
                        Status *
                    </label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('status') border-red-500 focus:ring-red-500 @enderror">
                        <option value="paid" {{ old('status', $sale->status ?? '') == 'paid' ? 'selected' : '' }}>✅ Pago</option>
                        <option value="awaiting_payment" {{ old('status', $sale->status ?? '') == 'awaiting_payment' ? 'selected' : '' }}>⏳ Aguardando Pagamento</option>
                        <option value="cancelled" {{ old('status', $sale->status ?? '') == 'cancelled' ? 'selected' : '' }}>❌ Cancelado</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('associacao.vendas.index') }}" 
                   class="inline-flex items-center justify-center space-x-2 px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span>Cancelar</span>
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center space-x-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i data-lucide="{{ isset($sale) ? 'save' : 'plus' }}" class="w-4 h-4"></i>
                    <span>{{ isset($sale) ? 'Atualizar Venda' : 'Criar Venda' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        const planSelect = document.getElementById('plan_id');
        const totalPriceInput = document.getElementById('total_price');

        function updateTotalPrice() {
            const selectedPlanOption = planSelect.options[planSelect.selectedIndex];
            if (selectedPlanOption) {
                const price = selectedPlanOption.dataset.price;
                if (price) {
                    totalPriceInput.value = price;
                } else {
                    totalPriceInput.value = '';
                }
            } else {
                totalPriceInput.value = '';
            }
        }

        if (planSelect) {
            planSelect.addEventListener('change', updateTotalPrice);
            updateTotalPrice();
        }
    });
</script>
@endpush
@endsection