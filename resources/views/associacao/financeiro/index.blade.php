@extends('layouts.app')

@section('title', 'Financeiro - Izus Payment')
@section('page-title', 'Módulo Financeiro')

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
                        <i data-lucide="wallet" class="w-8 h-8 text-blue-300"></i>
                    </div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                        Módulo Financeiro
                    </h1>
                </div>
            </div>
            <div class="flex items-center gap-3 self-start sm:self-center">
                <a href="{{ url()->previous() }}" class="inline-flex items-center space-x-2 bg-slate-700/50 hover:bg-slate-700 text-gray-300 hover:text-white px-5 py-2.5 rounded-xl font-semibold border border-white/10 transition-all duration-300">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>
    </div>

    {{-- SISTEMA DE ABAS (TABS) --}}
    <div class="border-b border-white/10">
        <nav class="-mb-px flex space-x-6" aria-label="Tabs">
            @php
                $tabs = [
                    ['id' => 'overview', 'label' => 'Visão Geral', 'icon' => 'layout-dashboard'],
                    ['id' => 'bank-accounts', 'label' => 'Contas Bancárias', 'icon' => 'landmark'],
                    ['id' => 'withdrawals', 'label' => 'Saques', 'icon' => 'arrow-down-up'],
                    ['id' => 'fees', 'label' => 'Taxas', 'icon' => 'percent'],
                ];
            @endphp

            @foreach ($tabs as $index => $tab)
                <button class="tab-button group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200
                    {{ $index === 0 ? 'border-blue-500 text-blue-400' : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-500' }}"
                    data-tab="{{ $tab['id'] }}">
                    <i data-lucide="{{ $tab['icon'] }}" class="w-5 h-5 mr-2 {{ $index === 0 ? 'text-blue-500' : 'text-gray-500 group-hover:text-gray-400' }} transition-colors duration-200"></i>
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </nav>
    </div>

    {{-- CONTEÚDO DAS ABAS --}}
    <div>
        <div class="tab-content" id="overview">
            @include('associacao.financeiro._overview')
        </div>
        <div class="tab-content hidden" id="bank-accounts">
            @include('associacao.financeiro._bank_accounts')
        </div>
        <div class="tab-content hidden" id="withdrawals">
            @include('associacao.financeiro._withdrawals')
        </div>
        <div class="tab-content hidden" id="fees">
            @include('associacao.financeiro._fees')
        </div>
    </div>
</div>

{{-- ====================================================================== --}}
{{-- SCRIPT FUNCIONAL PARA AS ABAS - ESTA É A PARTE QUE FALTAVA            --}}
{{-- ====================================================================== --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetTabId = button.dataset.tab;

                // 1. Atualiza a aparência dos BOTÕES
                tabButtons.forEach(btn => {
                    const icon = btn.querySelector('i[data-lucide]');
                    if (btn.dataset.tab === targetTabId) {
                        // ATIVA o botão clicado
                        btn.classList.remove('border-transparent', 'text-gray-400', 'hover:text-gray-200', 'hover:border-gray-500');
                        btn.classList.add('border-blue-500', 'text-blue-400');
                        if (icon) {
                            icon.classList.remove('text-gray-500', 'group-hover:text-gray-400');
                            icon.classList.add('text-blue-500');
                        }
                    } else {
                        // DESATIVA os outros botões
                        btn.classList.remove('border-blue-500', 'text-blue-400');
                        btn.classList.add('border-transparent', 'text-gray-400', 'hover:text-gray-200', 'hover:border-gray-500');
                        if (icon) {
                            icon.classList.remove('text-blue-500');
                            icon.classList.add('text-gray-500', 'group-hover:text-gray-400');
                        }
                    }
                });

                // 2. Esconde e mostra o CONTEÚDO correspondente
                tabContents.forEach(content => {
                    if (content.id === targetTabId) {
                        content.classList.remove('hidden'); // Mostra o conteúdo da aba clicada
                    } else {
                        content.classList.add('hidden'); // Esconde os outros
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection
