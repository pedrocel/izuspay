@extends('layouts.app')

@section('content')
<main id="dashboard-section" class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900 p-4 lg:p-6 transition-colors duration-200">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total de Vendas</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">R$ 45.231</p>
                    <p class="text-sm text-green-600 font-medium">+12% este mês</p>
                </div>
                <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                    <i data-lucide="dollar-sign" class="w-6 h-6 text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Novos Usuários</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">1.234</p>
                    <p class="text-sm text-blue-600 font-medium">+8% este mês</p>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                    <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pedidos</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">856</p>
                    <p class="text-sm text-purple-600 font-medium">+23% este mês</p>
                </div>
                <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full">
                    <i data-lucide="shopping-cart" class="w-6 h-6 text-purple-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Taxa de Conversão</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">3.2%</p>
                    <p class="text-sm text-orange-600 font-medium">-2% este mês</p>
                </div>
                <div class="p-3 bg-orange-100 dark:bg-orange-900 rounded-full">
                    <i data-lucide="trending-up" class="w-6 h-6 text-orange-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 mb-6 lg:mb-8">
        <!-- Revenue Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 lg:p-6 shadow-sm transition-colors duration-200">
            <div class="flex items-center justify-between mb-4 lg:mb-6">
                <h3 class="text-base lg:text-lg font-semibold text-gray-900 dark:text-white">Receita Mensal</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-green-600 font-medium">+14.97%</span>
                    <i data-lucide="trending-up" class="w-4 h-4 text-green-600"></i>
                </div>
            </div>
            <div class="h-48 lg:h-64 bg-gray-50 dark:bg-gray-700 rounded-lg flex items-center justify-center transition-colors duration-200">
                <p class="text-gray-500 dark:text-gray-400 text-sm lg:text-base">Gráfico de Barras - Receita</p>
            </div>
        </div>

        <!-- Users Growth Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 lg:p-6 shadow-sm transition-colors duration-200">
            <div class="flex items-center justify-between mb-4 lg:mb-6">
                <h3 class="text-base lg:text-lg font-semibold text-gray-900 dark:text-white">Crescimento de Usuários</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-blue-600 font-medium">+8.5%</span>
                    <i data-lucide="trending-up" class="w-4 h-4 text-blue-600"></i>
                </div>
            </div>
            <div class="h-48 lg:h-64 bg-gray-50 dark:bg-gray-700 rounded-lg flex items-center justify-center transition-colors duration-200">
                <p class="text-gray-500 dark:text-gray-400 text-sm lg:text-base">Gráfico de Linha - Usuários</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Top Products -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 mb-6 lg:mb-8">
        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 lg:p-6 shadow-sm transition-colors duration-200">
            <h3 class="text-base lg:text-lg font-semibold text-gray-900 dark:text-white mb-4">Atividade Recente</h3>
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                        <i data-lucide="user-plus" class="w-4 h-4 text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Novo usuário cadastrado</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Maria Silva se cadastrou</p>
                    </div>
                    <span class="text-xs text-gray-400">2min</span>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                        <i data-lucide="shopping-cart" class="w-4 h-4 text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Nova venda realizada</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Pedido #1234 - R$ 299,90</p>
                    </div>
                    <span class="text-xs text-gray-400">5min</span>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                        <i data-lucide="star" class="w-4 h-4 text-purple-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Nova avaliação</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Produto avaliado com 5 estrelas</p>
                    </div>
                    <span class="text-xs text-gray-400">10min</span>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 lg:p-6 shadow-sm transition-colors duration-200">
            <h3 class="text-base lg:text-lg font-semibold text-gray-900 dark:text-white mb-4">Produtos Mais Vendidos</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-200 dark:bg-gray-600 rounded-lg"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Produto Premium</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">234 vendas</p>
                        </div>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">R$ 12.450</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-200 dark:bg-gray-600 rounded-lg"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Produto Básico</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">189 vendas</p>
                        </div>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">R$ 8.920</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-200 dark:bg-gray-600 rounded-lg"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Produto Especial</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">156 vendas</p>
                        </div>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">R$ 7.340</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden transition-colors duration-200">
        <div class="px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-base lg:text-lg font-semibold text-gray-900 dark:text-white">Últimas Transações</h3>
                <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">Ver todas</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Produto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Valor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Data</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full mr-3"></div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Ana Costa</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">ana@email.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">Produto Premium</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">R$ 299,90</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Pago
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">15/11/2024</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full mr-3"></div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Carlos Santos</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">carlos@email.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">Produto Básico</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">R$ 99,90</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Pendente
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">14/11/2024</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection