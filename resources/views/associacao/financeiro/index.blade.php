@extends('layouts.app')

@section('title', 'Financeiro - AssociaMe')
@section('page-title', 'Módulo Financeiro')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="wallet" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Módulo Financeiro
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        Gerencie as finanças, contas e saques da sua associação.
                    </p>
                </div>
            </div>
            <a href="#" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-2">
    <div class="flex space-x-2">
        <button class="tab-button w-full px-4 py-2 rounded-lg font-medium text-gray-900 dark:text-white transition-colors duration-200 bg-green-100 dark:bg-green-900/20" data-tab="overview">
            <i data-lucide="layout-dashboard" class="w-4 h-4 inline mr-2"></i>
            Visão Geral
        </button>
        <button class="tab-button w-full px-4 py-2 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700" data-tab="bank-accounts">
            <i data-lucide="banknote" class="w-4 h-4 inline mr-2"></i>
            Contas Bancárias
        </button>
        <button class="tab-button w-full px-4 py-2 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700" data-tab="withdrawals">
            <i data-lucide="credit-card" class="w-4 h-4 inline mr-2"></i>
            Saques
        </button>
        <button class="tab-button w-full px-4 py-2 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700" data-tab="fees">
            <i data-lucide="tag" class="w-4 h-4 inline mr-2"></i>
            Taxas
        </button>
    </div>
</div>

<div class="tab-content space-y-6" id="overview">
    @include('associacao.financeiro._overview')
</div>
<div class="tab-content space-y-6 hidden" id="bank-accounts">
    @include('associacao.financeiro._bank_accounts')
</div>
<div class="tab-content space-y-6 hidden" id="withdrawals">
    @include('associacao.financeiro._withdrawals')
</div>
<div class="tab-content space-y-6 hidden" id="fees">
    @include('associacao.financeiro._fees')
</div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active styles from all buttons
                tabButtons.forEach(btn => {
                    btn.classList.remove('bg-green-100', 'dark:bg-green-900/20');
                    btn.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
                    btn.classList.remove('text-gray-900', 'dark:text-white');
                });
                // Hide all tab contents
                tabContents.forEach(content => content.classList.add('hidden'));

                // Add active styles to the clicked button
                button.classList.add('bg-green-100', 'dark:bg-green-900/20', 'text-gray-900', 'dark:text-white');
                button.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');

                // Show the corresponding tab content
                const tabId = button.dataset.tab;
                document.getElementById(tabId).classList.remove('hidden');
            });
        });
    });
</script>
@endpush
@endsection