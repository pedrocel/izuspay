@extends('layouts.app')

@section('content')
<div class="p-6 md:p-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">Gerenciamento de Assinaturas</h1>
            <p class="text-gray-500 dark:text-gray-400">Visualize e gerencie todas as assinaturas do sistema</p>
        </div>
        
        <div class="flex flex-wrap items-center gap-3 mt-4 md:mt-0">
            <div class="glass-effect rounded-xl p-2 flex items-center space-x-2">
                <i data-lucide="filter" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                <select class="bg-transparent border-none text-sm text-gray-700 dark:text-gray-300 focus:ring-0">
                    <option value="all" selected>Todos os Status</option>
                    <option value="active">Ativas</option>
                    <option value="trial">Em Teste</option>
                    <option value="overdue">Atrasadas</option>
                    <option value="canceled">Canceladas</option>
                </select>
            </div>
            
            <div class="glass-effect rounded-xl p-2 flex items-center space-x-2">
                <i data-lucide="calendar" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                <select class="bg-transparent border-none text-sm text-gray-700 dark:text-gray-300 focus:ring-0">
                    <option value="all-time">Todo Período</option>
                    <option value="this-month" selected>Este Mês</option>
                    <option value="last-month">Mês Passado</option>
                    <option value="this-year">Este Ano</option>
                </select>
            </div>
            
            <button class="theme-gradient rounded-xl p-2 text-white shadow-sm hover:opacity-90 transition-opacity">
                <i data-lucide="plus" class="w-5 h-5"></i>
            </button>
        </div>
    </div>
    
    <!-- Subscription Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total de Assinaturas -->
        <div class="glass-effect rounded-2xl p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total de Assinaturas</p>
                    <h2 class="text-3xl font-bold theme-text mt-2">0</h2>
                </div>
                <div class="theme-gradient rounded-xl p-3 shadow-lg">
                    <i data-lucide="users" class="w-5 h-5 text-white"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500 dark:text-gray-400">
                <i data-lucide="trending-flat" class="w-4 h-4 mr-1 text-yellow-500"></i>
                Sem alterações desde o último mês
            </div>
        </div>
        
        <!-- Taxa de Retenção -->
        <div class="glass-effect rounded-2xl p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Taxa de Retenção</p>
                    <h2 class="text-3xl font-bold theme-text mt-2">0%</h2>
                </div>
                <div class="theme-gradient rounded-xl p-3 shadow-lg">
                    <i data-lucide="heart" class="w-5 h-5 text-white"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500 dark:text-gray-400">
                <i data-lucide="trending-flat" class="w-4 h-4 mr-1 text-yellow-500"></i>
                Sem alterações desde o último mês
            </div>
        </div>
        
        <!-- Receita Mensal Recorrente -->
        <div class="glass-effect rounded-2xl p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">MRR</p>
                    <h2 class="text-3xl font-bold theme-text mt-2">R$ 0,00</h2>
                </div>
                <div class="theme-gradient rounded-xl p-3 shadow-lg">
                    <i data-lucide="repeat" class="w-5 h-5 text-white"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500 dark:text-gray-400">
                <i data-lucide="trending-flat" class="w-4 h-4 mr-1 text-yellow-500"></i>
                Sem alterações desde o último mês
            </div>
        </div>
        
        <!-- Valor Médio por Assinatura -->
        <div class="glass-effect rounded-2xl p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Ticket Médio</p>
                    <h2 class="text-3xl font-bold theme-text mt-2">R$ 0,00</h2>
                </div>
                <div class="theme-gradient rounded-xl p-3 shadow-lg">
                    <i data-lucide="ticket" class="w-5 h-5 text-white"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500 dark:text-gray-400">
                <i data-lucide="trending-flat" class="w-4 h-4 mr-1 text-yellow-500"></i>
                Sem alterações desde o último mês
            </div>
        </div>
    </div>
    
    <!-- Subscription Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Crescimento de Assinaturas -->
        <div class="glass-effect rounded-2xl p-6 col-span-2">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white">Crescimento de Assinaturas</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs rounded-lg theme-gradient text-white shadow-sm">Mês</button>
                    <button class="px-3 py-1 text-xs rounded-lg bg-white/50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300">Trimestre</button>
                    <button class="px-3 py-1 text-xs rounded-lg bg-white/50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300">Ano</button>
                </div>
            </div>
            
            <div class="h-[300px] relative">
                <!-- Chart Placeholder -->
                <div class="flex justify-between items-end h-full">
                    @foreach(['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'] as $month)
                        <div class="flex flex-col items-center">
                            <div class="chart-bar w-6 theme-gradient rounded-t-md" style="height: 0%"></div>
                            <span class="text-xs mt-2 text-gray-500 dark:text-gray-400">{{ $month }}</span>
                        </div>
                    @endforeach
                </div>
                
                <!-- Empty State -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center">
                        <div class="mb-3 mx-auto w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                            <i data-lucide="trending-up" class="w-8 h-8 text-gray-400 dark:text-gray-600"></i>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Nenhum dado disponível para o período selecionado</p>
                        <button class="mt-3 px-4 py-2 text-xs theme-gradient rounded-lg text-white shadow-sm">Gerar Dados de Exemplo</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Distribuição por Planos -->
        <div class="glass-effect rounded-2xl p-6">
            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-6">Distribuição por Planos</h3>
            
            <div class="h-[300px] relative flex items-center justify-center">
                <!-- Donut Chart Placeholder -->
                <div class="w-48 h-48 rounded-full border-8 border-gray-200 dark:border-gray-700 relative">
                    <!-- Empty State -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <i data-lucide="pie-chart" class="w-10 h-10 text-gray-400 dark:text-gray-600 mx-auto mb-2"></i>
                            <p class="text-gray-500 dark:text-gray-400 text-xs">Sem dados</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Legend -->
            <div class="mt-6 space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-600 mr-2"></div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Plano Básico</span>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">0%</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full theme-gradient mr-2"></div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Plano Pro</span>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">0%</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Plano Enterprise</span>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">0%</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Subscription Management -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Todas as Assinaturas</h3>
            
            <div class="flex items-center space-x-3 mt-4 md:mt-0">
                <div class="glass-effect rounded-xl flex items-center overflow-hidden pr-2">
                    <input type="text" placeholder="Buscar assinatura..." class="bg-transparent border-none text-sm text-gray-700 dark:text-gray-300 focus:ring-0 py-2 px-4">
                    <i data-lucide="search" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                </div>
                
                <div class="glass-effect rounded-xl p-2 flex items-center space-x-2">
                    <i data-lucide="arrow-down-up" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                    <select class="bg-transparent border-none text-sm text-gray-700 dark:text-gray-300 focus:ring-0">
                        <option value="newest">Mais Recentes</option>
                        <option value="oldest">Mais Antigas</option>
                        <option value="price-high">Maior Valor</option>
                        <option value="price-low">Menor Valor</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Subscription Table -->
        <div class="glass-effect rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Cliente</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Plano</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Valor</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Próx. Cobrança</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Exemplo de linha (remover quando tiver dados reais) -->
                        <tr class="hover:bg-white/50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 theme-gradient rounded-xl flex items-center justify-center shadow-sm">
                                        <span class="text-sm font-bold text-white">JD</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">João da Silva</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">joao@exemplo.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i data-lucide="crown" class="w-4 h-4 text-yellow-500 mr-2"></i>
                                    <span class="text-sm text-gray-900 dark:text-white">Plano Pro</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">R$ 49,90/mês</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Ativa</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900 dark:text-white">15/04/2025</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <button class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <i data-lucide="eye" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                    </button>
                                    <button class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <i data-lucide="edit" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                    </button>
                                    <button class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <i data-lucide="more-vertical" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Estado vazio (mostrar quando não houver dados) -->
                        <tr class="text-center hidden">
                            <td colspan="6" class="px-6 py-12 text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center">
                                    <div class="mb-3 w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                        <i data-lucide="users" class="w-8 h-8 text-gray-400 dark:text-gray-600"></i>
                                    </div>
                                    <p>Nenhuma assinatura encontrada</p>
                                    <button class="mt-3 px-4 py-2 text-xs theme-gradient rounded-lg text-white shadow-sm">Adicionar Assinatura</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 flex items-center justify-between border-t border-gray-200 dark:border-gray-700">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button class="px-4 py-2 text-sm bg-white/50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 rounded-lg">Anterior</button>
                    <button class="px-4 py-2 text-sm theme-gradient text-white rounded-lg ml-3">Próxima</button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            Mostrando <span class="font-medium">1</span> a <span class="font-medium">1</span> de <span class="font-medium">1</span> resultados
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button class="relative inline-flex items-center px-2 py-2 rounded-l-md bg-white/50 dark:bg-gray-700/50 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-white/70 dark:hover:bg-gray-700/70">
                                <i data-lucide="chevron-left" class="w-5 h-5"></i>
                            </button>
                            <button class="relative inline-flex items-center px-4 py-2 theme-gradient text-sm font-medium text-white">
                                1
                            </button>
                            <button class="relative inline-flex items-center px-2 py-2 rounded-r-md bg-white/50 dark:bg-gray-700/50 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-white/70 dark:hover:bg-gray-700/70">
                                <i data-lucide="chevron-right" class="w-5 h-5"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Additional Insights -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Próximas Cobranças -->
        <div class="glass-effect rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white">Próximas Cobranças</h3>
                <a href="#" class="text-sm theme-text flex items-center">
                    Ver todas <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                </a>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-white/50 dark:bg-gray-800/50 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 theme-gradient rounded-xl flex items-center justify-center shadow-sm">
                            <span class="text-sm font-bold text-white">JD</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">João da Silva</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Plano Pro - R$ 49,90</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">15/04/2025</p>
                        <p class="text-xs text-green-600 dark:text-green-400">Em 15 dias</p>
                    </div>
                </div>
                
                <!-- Estado vazio (mostrar quando não houver dados) -->
                <div class="text-center hidden">
                    <div class="py-8 text-gray-500 dark:text-gray-400">
                        <i data-lucide="calendar" class="w-8 h-8 mx-auto mb-3 text-gray-400 dark:text-gray-600"></i>
                        <p>Nenhuma cobrança programada</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Assinaturas Recentes -->
        <div class="glass-effect rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white">Assinaturas Recentes</h3>
                <a href="#" class="text-sm theme-text flex items-center">
                    Ver todas <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                </a>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-white/50 dark:bg-gray-800/50 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 theme-gradient rounded-xl flex items-center justify-center shadow-sm">
                            <span class="text-sm font-bold text-white">JD</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">João da Silva</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Plano Pro - R$ 49,90</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Hoje</p>
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Ativa</span>
                    </div>
                </div>
                
                <!-- Estado vazio (mostrar quando não houver dados) -->
                <div class="text-center hidden">
                    <div class="py-8 text-gray-500 dark:text-gray-400">
                        <i data-lucide="user-plus" class="w-8 h-8 mx-auto mb-3 text-gray-400 dark:text-gray-600"></i>
                        <p>Nenhuma assinatura recente</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Subscription Detail Modal -->
<div id="subscriptionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="glass-effect rounded-2xl p-6 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Detalhes da Assinatura</h3>
            <button onclick="toggleSubscriptionModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        <!-- Customer Info -->
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-16 h-16 theme-gradient rounded-2xl flex items-center justify-center shadow-lg">
                <span class="text-2xl font-bold text-white">JD</span>
            </div>
            <div>
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">João da Silva</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">joao@exemplo.com</p>
                <div class="flex items-center mt-1">
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Assinatura Ativa</span>
                </div>
            </div>
        </div>
        
        <!-- Subscription Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-4">
                <div>
                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Plano</h5>
                    <p class="text-base font-medium text-gray-900 dark:text-white flex items-center">
                        <i data-lucide="crown" class="w-4 h-4 text-yellow-500 mr-2"></i>
                        Plano Pro
                    </p>
                </div>
                
                <div>
                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Valor</h5>
                    <p class="text-base font-medium text-gray-900 dark:text-white">R$ 49,90/mês</p>
                </div>
                
                <div>
                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Data de Início</h5>
                    <p class="text-base font-medium text-gray-900 dark:text-white">15/03/2025</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Próxima Cobrança</h5>
                    <p class="text-base font-medium text-gray-900 dark:text-white">15/04/2025</p>
                </div>
                
                <div>
                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Método de Pagamento</h5>
                    <p class="text-base font-medium text-gray-900 dark:text-white flex items-center">
                        <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>
                        Cartão de Crédito (final 1234)
                    </p>
                </div>
                
                <div>
                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status de Pagamento</h5>
                    <p class="text-base font-medium text-green-600 dark:text-green-400">Pago</p>
                </div>
            </div>
        </div>
        
        <!-- Subscription History -->
        <div class="mb-6">
            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Histórico de Pagamentos</h4>
            
            <div class="glass-effect rounded-xl overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Data</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Valor</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Recibo</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-white">15/03/2025</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-white">R$ 49,90</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Pago</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <button class="text-sm theme-text flex items-center ml-auto">
                                    <i data-lucide="download" class="w-4 h-4 mr-1"></i> PDF
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="grid grid-cols-2 gap-3">
            <button class="flex items-center justify-center space-x-2 p-3 rounded-xl bg-white/50 dark:bg-gray-700/50 hover:bg-white/70 dark:hover:bg-gray-700/70 transition-colors duration-150">
                <i data-lucide="edit" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Editar Assinatura</span>
            </button>
            <button class="flex items-center justify-center space-x-2 p-3 rounded-xl bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors duration-150">
                <i data-lucide="x-circle" class="w-5 h-5 text-red-500"></i>
                <span class="text-sm font-medium text-red-500">Cancelar Assinatura</span>
            </button>
        </div>
    </div>
</div>

<script>
    // Inicializar ícones Lucide
    lucide.createIcons();
    
    // Simular dados do gráfico (para demonstração)
    setTimeout(() => {
        const chartBars = document.querySelectorAll('.chart-bar');
        const randomHeights = [20, 35, 45, 60, 40, 55, 70, 65, 50, 30, 25, 40];
        
        chartBars.forEach((bar, index) => {
            setTimeout(() => {
                bar.style.height = `${randomHeights[index]}%`;
            }, index * 100);
        });
    }, 1000);
    
    // Toggle modal de detalhes da assinatura
    function toggleSubscriptionModal() {
        const modal = document.getElementById('subscriptionModal');
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }
    
    // Adicionar evento de clique para abrir o modal
    document.querySelectorAll('button[data-lucide="eye"]').forEach(button => {
        button.addEventListener('click', toggleSubscriptionModal);
    });
</script>
@endsection