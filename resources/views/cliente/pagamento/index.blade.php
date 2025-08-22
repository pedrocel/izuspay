@extends('layouts.app')

@section('title', 'Pagamento Pendente')
@section('page-title', 'Finalize sua Assinatura')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-red-50 to-orange-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-red-100 dark:border-gray-600">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center">
                <i data-lucide="credit-card" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Pagamento Pendente</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Sua documentação foi aprovada! Agora, realize o pagamento para ativar sua associação.
                </p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 text-center">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Resumo da sua Compra</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-4">Plano: <strong>{{ $pendingSale->plan->name }}</strong></p>
        <p class="text-4xl font-extrabold text-green-600 dark:text-green-400 mb-6">
            R$ {{ number_format($pendingSale->total_price, 2, ',', '.') }}
        </p>

        <a href="{{ route('checkout.show', ['hash_id' => $pendingSale->plan->hash_id]) }}"
           class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
            <i data-lucide="credit-card" class="w-5 h-5"></i>
            <span>Ir para o Pagamento</span>
        </a>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush