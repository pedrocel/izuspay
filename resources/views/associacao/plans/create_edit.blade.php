@extends('layouts.app')

@section('title', isset($plan) ? 'Editar Plano - AssociaMe' : 'Novo Plano - AssociaMe')
@section('page-title', isset($plan) ? 'Editar Plano' : 'Novo Plano')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="{{ isset($plan) ? 'award' : 'plus' }}" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ isset($plan) ? 'Editar Plano' : 'Novo Plano' }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ isset($plan) ? 'Atualize as informações do plano ' . $plan->name : 'Preencha os dados para criar um novo plano' }}
                    </p>
                </div>
            </div>
            <a href="{{ route('associacao.plans.index') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    <form action="{{ isset($plan) ? route('associacao.plans.update', $plan) : route('associacao.plans.store') }}" 
          method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @if(isset($plan))
            @method('PUT')
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-2">
                    <i data-lucide="info" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detalhes do Plano</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="award" class="w-4 h-4 inline mr-1"></i>
                            Nome do Plano *
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $plan->name ?? '') }}" required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('name') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Digite o nome do plano">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="recurrence" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="repeat" class="w-4 h-4 inline mr-1"></i>
                            Recorrência *
                        </label>
                        <select id="recurrence" name="recurrence" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('recurrence') border-red-500 focus:ring-red-500 @enderror">
                            <option value="">Selecione...</option>
                            <option value="monthly" {{ old('recurrence', $plan->recurrence ?? '') == 'monthly' ? 'selected' : '' }}>Mensal</option>
                            <option value="annually" {{ old('recurrence', $plan->recurrence ?? '') == 'annually' ? 'selected' : '' }}>Anual</option>
                        </select>
                        @error('recurrence')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="lg:col-span-2">
                        <label for="client_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="users" class="w-4 h-4 inline mr-1"></i>
                            Tipo de Cliente Permitido *
                        </label>
                        <select id="client_type" name="client_type" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('client_type') border-red-500 focus:ring-red-500 @enderror">
                            <option value="both" {{ old('client_type', $plan->client_type ?? '') == 'both' ? 'selected' : '' }}>Ambos (PF e PJ)</option>
                            <option value="pf" {{ old('client_type', $plan->client_type ?? '') == 'pf' ? 'selected' : '' }}>Somente Pessoa Física (PF)</option>
                            <option value="pj" {{ old('client_type', $plan->client_type ?? '') == 'pj' ? 'selected' : '' }}>Somente Pessoa Jurídica (PJ)</option>
                        </select>
                        @error('client_type')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="package" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Produtos do Plano</h3>
                    </div>
                    <div class="text-xl font-bold text-green-600 dark:text-green-400">
                        Total: <span id="total-price">R$ 0,00</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4 max-h-80 overflow-y-auto pr-4">
                    @forelse($products as $product)
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 hover:shadow-sm transition-shadow product-item">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" 
                                       id="product_{{ $product->id }}" 
                                       name="product_ids[]" 
                                       value="{{ $product->id }}"
                                       data-price="{{ $product->price }}"
                                       @if(isset($plan))
                                           {{ $plan->products->contains($product->id) ? 'checked' : '' }}
                                       @else
                                           {{ in_array($product->id, old('product_ids', [])) ? 'checked' : '' }}
                                       @endif
                                       class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                <label for="product_{{ $product->id }}" class="block text-sm font-medium text-gray-900 dark:text-white cursor-pointer">
                                    {{ $product->name }}
                                </label>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 dark:text-gray-400">Nenhum produto ativo encontrado.</div>
                    @endforelse
                </div>
                @error('product_ids')
                    <p class="text-red-500 text-sm mt-4 flex items-center">
                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-2">
                    <i data-lucide="settings" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Configurações Adicionais</h3>
                </div>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="align-left" class="w-4 h-4 inline mr-1"></i>
                        Descrição
                    </label>
                    <textarea id="description" name="description" rows="3" 
                              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('description') border-red-500 focus:ring-red-500 @enderror"
                              placeholder="Escreva uma breve descrição do plano">{{ old('description', $plan->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="image" class="w-4 h-4 inline mr-1"></i>
                        Imagem do Plano
                    </label>
                    <input type="file" id="image" name="image" 
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('image') border-red-500 focus:ring-red-500 @enderror">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    @if(isset($plan) && $plan->image)
                    <div class="mt-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Imagem atual:</p>
                        <img src="{{ Storage::url($plan->image) }}" alt="{{ $plan->name }}" class="mt-2 h-24 w-auto rounded-lg object-cover shadow-sm">
                    </div>
                    @endif
                </div>

                <div class="flex items-center lg:col-span-2">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $plan->is_active ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="is_active" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i data-lucide="check-circle" class="w-4 h-4 inline mr-1"></i>
                        Plano Ativo
                    </label>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('associacao.plans.index') }}" 
                   class="inline-flex items-center justify-center space-x-2 px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span>Cancelar</span>
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center space-x-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i data-lucide="{{ isset($plan) ? 'save' : 'plus' }}" class="w-4 h-4"></i>
                    <span>{{ isset($plan) ? 'Atualizar Plano' : 'Criar Plano' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productCheckboxes = document.querySelectorAll('input[name="product_ids[]"]');
        const totalPriceElement = document.getElementById('total-price');

        function calculateTotalPrice() {
            let total = 0;
            productCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.dataset.price);
                }
            });
            totalPriceElement.textContent = `R$ ${total.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        }

        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotalPrice);
        });

        calculateTotalPrice();
        
        lucide.createIcons();
    });
</script>
@endpush
@endsection