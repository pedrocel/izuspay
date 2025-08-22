@extends('layouts.app')

@section('title', 'Produtos - AssociaMe')
@section('page-title', 'Gerenciar Produtos')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <i data-lucide="package" class="w-6 h-6 text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Produtos</h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Gerencie todos os produtos disponíveis na sua associação.</p>
            </div>
            <a href="{{ route('associacao.products.create') }}" 
               class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Novo Produto</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $products->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="package" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Ativos</p>
                    <p class="text-2xl font-bold text-green-600">{{ $products->where('is_active', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Inativos</p>
                    <p class="text-2xl font-bold text-red-600">{{ $products->where('is_active', false)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="x-circle" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($products as $product)
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-all duration-200 overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <div class="w-14 h-14 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center">
                                <i data-lucide="package" class="w-6 h-6 text-white"></i>
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-2 border-white dark:border-gray-800 
                                        {{ $product->is_active ? 'bg-green-500' : 'bg-red-500' }}">
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-medium">Preço:</span> R$ {{ number_format($product->price, 2, ',', '.') }}
                            </p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-2
                                {{ $product->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400' }}">
                                <i data-lucide="{{ $product->is_active ? 'check-circle' : 'x-circle' }}" class="w-3 h-3 mr-1"></i>
                                {{ $product->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <a href="{{ route('associacao.products.edit', $product) }}" 
                           class="inline-flex items-center px-3 py-2 text-sm font-medium text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 bg-green-50 hover:bg-green-100 dark:bg-green-900/20 dark:hover:bg-green-900/30 rounded-lg transition-colors">
                            <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                            Editar
                        </a>
                        
                        <button onclick="confirmDelete('{{ $product->id }}', '{{ $product->name }}')"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/30 rounded-lg transition-colors">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                            Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-12 text-center">
            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="package" class="w-10 h-10 text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nenhum produto encontrado</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Comece criando seu primeiro produto no sistema.</p>
            <a href="{{ route('associacao.products.create') }}" 
               class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Criar Primeiro Produto</span>
            </a>
        </div>
        @endforelse
    </div>

    @if($products->hasPages())
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        {{ $products->links() }}
    </div>
    @endif
</div>

<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl max-w-md w-full p-6 transform transition-all">
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 dark:bg-red-900/20 rounded-full">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
            </div>
            
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">Confirmar Exclusão</h3>
            <p class="text-gray-600 dark:text-gray-400 text-center mb-6">
                Tem certeza que deseja excluir o produto <span id="deleteProductName" class="font-medium"></span>? 
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
    function confirmDelete(productId, productName) {
        document.getElementById('deleteProductName').textContent = productName;
        document.getElementById('deleteForm').action = `{{ route('associacao.products.index') }}/${productId}`;
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