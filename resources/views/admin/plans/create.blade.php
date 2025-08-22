@extends('layouts.app')

@section('title', 'Páginas')

@section('content')
<header class="glass-effect border-b border-gray-200/50 dark:border-gray-700/50 sticky top-0 z-20">
    <div class="flex justify-between items-center px-4 md:px-8 py-6">
        <div class="flex items-center">
            <button onclick="toggleSidebar()" class="md:hidden mr-4 text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300">
                <i data-feather="menu" class="w-6 h-6"></i>
            </button>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">Lista de Páginas</h2>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.plans.create') }}" class="theme-gradient text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover:opacity-90 transition-opacity duration-150">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span class="hidden md:inline">Criar Plano</span>
            </a>
        </div>
    </div>
</header>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-4 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="p-4 md:p-8">

<form action="{{ route('admin.plans.store') }}" class="space-y-8">
    @csrf
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex items-center space-x-2 mb-6">
            <i data-lucide="info" class="w-5 h-5 text-blue-500"></i>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informações Básicas</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div class="col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nome do Plano
                </label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="Ex: Plano Premium">
            </div>

            <!-- Description -->
            <div class="col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Descrição
                </label>
                <textarea name="description" id="description" rows="3" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="Descreva os benefícios do plano..."></textarea>
            </div>

            <!-- Image URL -->
            <div class="col-span-2">
                <label for="link_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    URL da Imagem
                </label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400 sm:text-sm">
                        <i data-lucide="image" class="w-5 h-5"></i>
                    </span>
                    <input type="url" name="link_image" id="link_image"
                        class="flex-1 rounded-none rounded-r-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm px-4 py-2"
                        placeholder="https://exemplo.com/imagem.jpg">
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex items-center space-x-2 mb-6">
            <i data-lucide="credit-card" class="w-5 h-5 text-green-500"></i>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Precificação e Limites</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Value -->
            <div>
                <label for="value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Valor
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 dark:text-gray-400">
                        R$
                    </span>
                    <input type="text" name="value" id="value" required
                        class="w-full pl-8 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="0,00"
                        oninput="this.value = this.value.replace(/[^0-9,.]/g, '')">
                </div>
            </div>

            <!-- Page Quantity -->
            <div>
                <label for="page_quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Quantidade de Páginas
                </label>
                <input type="number" name="page_quantity" id="page_quantity" required min="1"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Ex: 10">
            </div>

            <!-- Billing Cycle -->
            <div>
                <label for="billing_cycle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Ciclo de Cobrança
                </label>
                <select name="billing_cycle" id="billing_cycle"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="monthly">Mensal</option>
                    <option value="quarterly">Trimestral</option>
                    <option value="semiannual">Semestral</option>
                    <option value="annual">Anual</option>
                    <option value="biennial">Bienal</option>
                    <option value="quadrennial">Quadrienal</option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status do Plano
                </label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="status" value="1" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Ativo</span>
                </label>
            </div>
        </div>
    </div>

    <!-- External Integration Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex items-center space-x-2 mb-6">
            <i data-lucide="link" class="w-5 h-5 text-purple-500"></i>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Integração Externa</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- External Plan ID -->
            <div>
                <label for="id_plan_external" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    ID do Plano Externo
                </label>
                <input type="text" name="id_plan_external" id="id_plan_external"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Ex: plan_123">
            </div>

            <!-- External Offer ID -->
            <div>
                <label for="id_offer_external" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    ID da Oferta Externa
                </label>
                <input type="text" name="id_offer_external" id="id_offer_external"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Ex: offer_123">
            </div>

            <!-- External Checkout Link -->
            <div class="col-span-2">
                <label for="link_checkout_external" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Link de Checkout Externo
                </label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400 sm:text-sm">
                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    </span>
                    <input type="url" name="link_checkout_external" id="link_checkout_external"
                        class="flex-1 rounded-none rounded-r-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm px-4 py-2"
                        placeholder="https://checkout.exemplo.com/plano">
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-4">
        <a href="/admin/plans" 
            class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
            Cancelar
        </a>
        <button type="submit" 
            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm hover:shadow transition duration-200">
            Salvar Plano
        </button>
    </div>
</form>

@endsection