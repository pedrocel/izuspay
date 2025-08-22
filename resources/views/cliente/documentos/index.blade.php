@extends('layouts.app')

@section('title', 'Documentação e Pagamento')
@section('page-title', 'Finalize sua Associação')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    @php
        $userStatus = auth()->user()->status;
        $isDocsPending = $userStatus === 'documentation_pending' || $userStatus === 'docs_under_review';
        $isPaymentPending = $userStatus === 'payment_pending';
    @endphp

    @if($isDocsPending)
    <div class="bg-gradient-to-r from-red-50 to-orange-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-red-100 dark:border-gray-600">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Atenção!</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Sua documentação está pendente. Por favor, envie os documentos para prosseguir.
                </p>
            </div>
        </div>
    </div>
    @elseif($isPaymentPending)
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
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
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center">
                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-900 dark:text-white">1. Cadastro</p>
            </div>
            
            <div class="flex-1 border-t-2 border-green-500 -mt-6"></div>
            
            @php
                $docsColor = $isPaymentPending ? 'bg-green-500' : ($isDocsPending ? 'bg-red-500 border-4 border-red-200 shadow-md' : 'bg-gray-200');
                $docsTextColor = $isPaymentPending ? 'text-gray-900 font-medium' : ($isDocsPending ? 'text-gray-900 font-bold' : 'text-gray-600');
                $docsBorder = $isPaymentPending ? 'border-green-500' : ($isDocsPending ? 'border-red-500' : 'border-gray-300');
            @endphp
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 {{ $docsColor }} text-white rounded-full flex items-center justify-center">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                </div>
                <p class="mt-2 text-sm {{ $docsTextColor }} dark:text-white">2. Documentos</p>
            </div>
            
            <div class="flex-1 border-t-2 {{ $docsBorder }} -mt-6"></div>
            
            @php
                $paymentColor = $isPaymentPending ? 'bg-red-500 border-4 border-red-200 shadow-md' : 'bg-gray-200';
                $paymentTextColor = $isPaymentPending ? 'text-gray-900 font-bold' : 'text-gray-600';
                $paymentBorder = $isPaymentPending ? 'border-red-500' : 'border-gray-300';
            @endphp
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 {{ $paymentColor }} text-white rounded-full flex items-center justify-center">
                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                </div>
                <p class="mt-2 text-sm {{ $paymentTextColor }} dark:text-white">3. Pagamento</p>
            </div>
            
            <div class="flex-1 border-t-2 {{ $paymentBorder }} -mt-6"></div>
            
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-400 rounded-full flex items-center justify-center">
                    <i data-lucide="file-signature" class="w-5 h-5"></i>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">4. Contrato</p>
            </div>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded-md">
            {{ session('error') }}
        </div>
    @endif
    
    @if($isDocsPending)
        @include('cliente.documentos._docs_content')
    @elseif($isPaymentPending && $pendingSale)
        @include('cliente.documentos._payment_content')
    @endif
    
</div>
@endsection
@push('scripts')
<script>
    // Scripts de máscaras, etc., podem vir aqui se necessário.
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush