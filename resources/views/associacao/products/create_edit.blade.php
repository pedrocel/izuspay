@extends('layouts.app')

@section('title', isset($product) ? 'Editar Produto - AssociaMe' : 'Novo Produto - AssociaMe')
@section('page-title', isset($product) ? 'Editar Produto' : 'Novo Produto')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="{{ isset($product) ? 'package-check' : 'plus' }}" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ isset($product) ? 'Editar Produto' : 'Novo Produto' }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ isset($product) ? 'Atualize as informações do produto ' . $product->name : 'Preencha os dados para criar um novo produto' }}
                    </p>
                </div>
            </div>
            <a href="{{ route('associacao.products.index') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    <form action="{{ isset($product) ? route('associacao.products.update', $product) : route('associacao.products.store') }}" 
          method="POST" class="space-y-6">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-2">
                    <i data-lucide="package" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detalhes do Produto</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="lg:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="tag" class="w-4 h-4 inline mr-1"></i>
                            Nome do Produto *
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $product->name ?? '') }}" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('name') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Digite o nome do produto">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="dollar-sign" class="w-4 h-4 inline mr-1"></i>
                            Preço *
                        </label>
                        <input type="number" 
                               step="0.01"
                               id="price" 
                               name="price" 
                               value="{{ old('price', $product->price ?? '') }}" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('price') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="activity" class="w-4 h-4 inline mr-1"></i>
                            Status *
                        </label>
                        <select id="is_active" 
                                name="is_active" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('is_active') border-red-500 focus:ring-red-500 @enderror">
                            <option value="1" {{ old('is_active', $product->is_active ?? '') == '1' ? 'selected' : '' }}>
                                ✅ Ativo
                            </option>
                            <option value="0" {{ old('is_active', $product->is_active ?? '') == '0' ? 'selected' : '' }}>
                                ❌ Inativo
                            </option>
                        </select>
                        @error('is_active')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="lg:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="align-left" class="w-4 h-4 inline mr-1"></i>
                            Descrição
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('description') border-red-500 focus:ring-red-500 @enderror"
                                  placeholder="Escreva uma breve descrição do produto">{{ old('description', $product->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('associacao.products.index') }}" 
                   class="inline-flex items-center justify-center space-x-2 px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span>Cancelar</span>
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center space-x-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i data-lucide="{{ isset($product) ? 'save' : 'plus' }}" class="w-4 h-4"></i>
                    <span>{{ isset($product) ? 'Atualizar Produto' : 'Criar Produto' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Price input mask
    document.getElementById('price').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = (value / 100).toFixed(2);
        e.target.value = value;
    });

    // Initialize Lucide icons
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection