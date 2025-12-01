@extends('layouts.app')

@section('title', 'Detalhes da Conta: ' . $association->nome)

@section('content')
<div class="space-y-6">
    <!-- Header com informações da conta -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:items-center gap-6">
            <img class="h-24 w-24 rounded-full" src="{{ $association->creatorProfile->profile_image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($association->nome ) . '&background=22c55e&color=fff&size=200' }}" alt="Logo">
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $association->nome }}</h1>
                    {!! $association->getBadgeStatus() !!}
                </div>
                <p class="text-gray-500 dark:text-gray-400">{{ $association->documento_formatado }}</p>
                <p class="text-gray-500 dark:text-gray-400">{{ $association->email }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500 dark:text-gray-400">Saldo em Carteira</p>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400">R$ {{ number_format($association->wallet->balance ?? 0, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Abas de Navegação -->
    <div x-data="{ tab: 'vendas' }">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button @click="tab = 'vendas'" :class="{ 'border-purple-500 text-purple-600': tab === 'vendas', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'vendas' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Vendas</button>
                <button @click="tab = 'saques'" :class="{ 'border-purple-500 text-purple-600': tab === 'saques', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'saques' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Saques</button>
                <button @click="tab = 'planos'" :class="{ 'border-purple-500 text-purple-600': tab === 'planos', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'planos' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Planos</button>
                <button @click="tab = 'produtos'" :class="{ 'border-purple-500 text-purple-600': tab === 'produtos', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'produtos' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Produtos</button>
                <button @click="tab = 'documentos'" :class="{ 'border-purple-500 text-purple-600': tab === 'documentos', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'documentos' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Documentos</button>
                <button @click="tab = 'configuracoes'" :class="{ 'border-purple-500 text-purple-600': tab === 'configuracoes', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'configuracoes' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Configurações</button>

            </nav>
        </div>

        <!-- Conteúdo das Abas -->
        <div class="mt-6">
            <!-- Aba de Vendas -->
            <div x-show="tab === 'vendas'" class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Últimas Vendas</h3>
                @include('admin.associations._sales_table', ['sales' => $association->sales])
            </div>

            <!-- Aba de Saques -->
            <div x-show="tab === 'saques'" class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Últimos Saques</h3>
                {{-- Incluir partial de saques aqui --}}
            </div>

            <!-- Aba de Planos -->
            <div x-show="tab === 'planos'" class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Planos</h3>
                @include('admin.associations._plans_table', ['plans' => $association->plans])
            </div>

            <!-- Aba de Produtos -->
            <div x-show="tab === 'produtos'" class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Produtos</h3>
                @include('admin.associations._products_table', ['products' => $association->products])
            </div>

            <!-- Aba de Documentos -->
            <div x-show="tab === 'documentos'" class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Documentos</h3>
                @include('admin.associations._documents_table', ['documents' => $association->documents])
            </div>

            <div x-show="tab === 'configuracoes'" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            @include('admin.associations._settings_form')
        </div>
        </div>
    </div>
</div>
@endsection
