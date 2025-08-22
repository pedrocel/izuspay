@extends('layouts.app')

@section('title', 'Relatórios Avançados - AssociaMe')
@section('page-title', 'Dashboard de Relatórios')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-blue-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="trending-up" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard de Relatórios</h2>
                    <p class="text-gray-600 dark:text-gray-400">Análise completa de desempenho, assinantes e finanças</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <button onclick="exportPdf()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2 inline"></i>
                    PDF
                </button>
                <button onclick="exportExcel()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                    <i data-lucide="download" class="w-4 h-4 mr-2 inline"></i>
                    Excel
                </button>
            </div>
        </div>
    </div>

    <!-- KPIs Principais -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6">
        <!-- Assinaturas Ativas -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Assinaturas Ativas</p>
                    <p class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalActiveSubscriptions) }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-sm {{ $subscriptionGrowthRate >= 0 ? 'text-green-600' : 'text-red-600' }} flex items-center">
                            <i data-lucide="{{ $subscriptionGrowthRate >= 0 ? 'trending-up' : 'trending-down' }}" class="w-3 h-3 mr-1"></i>
                            {{ number_format(abs($subscriptionGrowthRate), 1) }}%
                        </span>
                        <span class="text-xs text-gray-500 ml-2">vs mês anterior</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center flex-shrink-0 ml-4">
                    <i data-lucide="users" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                </div>
            </div>
        </div>

        <!-- Receita Mensal -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Receita Mensal</p>
                    <p class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-sm {{ $revenueGrowth >= 0 ? 'text-green-600' : 'text-red-600' }} flex items-center">
                            <i data-lucide="{{ $revenueGrowth >= 0 ? 'trending-up' : 'trending-down' }}" class="w-3 h-3 mr-1"></i>
                            {{ number_format(abs($revenueGrowth), 1) }}%
                        </span>
                        <span class="text-xs text-gray-500 ml-2">vs mês anterior</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center flex-shrink-0 ml-4">
                    <i data-lucide="dollar-sign" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                </div>
            </div>
        </div>

        <!-- Taxa de Churn -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Taxa de Churn</p>
                    <p class="text-2xl lg:text-3xl font-bold {{ $churnRate <= 5 ? 'text-green-600' : ($churnRate <= 10 ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ number_format($churnRate, 1) }}%
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-gray-500">{{ $canceledSubscriptionsThisMonth }} cancelamentos</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/20 rounded-lg flex items-center justify-center flex-shrink-0 ml-4">
                    <i data-lucide="user-x" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
                </div>
            </div>
        </div>

        <!-- LTV -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">LTV Médio</p>
                    <p class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($customerLifetimeValue, 0, ',', '.') }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-gray-500">Valor do tempo de vida</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center flex-shrink-0 ml-4">
                    <i data-lucide="target" class="w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                </div>
            </div>
        </div>
    </div>

     Métricas Secundárias 
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $newSubscriptionsThisMonth }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">Novas Assinaturas</p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <p class="text-2xl font-bold text-orange-600">{{ $subscriptionsToRenewThisMonth }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">A Renovar</p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($conversionRate, 1) }}%</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">Taxa Conversão</p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($averageRevenuePerUser, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">ARPU</p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $newUsersThisMonth }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">Novos Usuários</p>
            </div>
        </div>
    </div>

    <!-- Gráficos Principais -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Crescimento de Receita -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Crescimento de Receita</h3>
                <div class="flex space-x-2">
                    <button class="text-sm text-gray-500 hover:text-gray-700 px-2 py-1 rounded" onclick="toggleChart('revenue', '6m')">6M</button>
                    <button class="text-sm text-gray-500 hover:text-gray-700 px-2 py-1 rounded bg-gray-100" onclick="toggleChart('revenue', '12m')">12M</button>
                </div>
            </div>
            <div class="h-64">
                <canvas id="revenueGrowthChart"></canvas>
            </div>
        </div>

        <!-- Crescimento de Assinantes -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Crescimento de Assinantes</h3>
                <div class="text-sm text-gray-500">
                    Total: {{ number_format($totalActiveSubscriptions) }}
                </div>
            </div>
            <div class="h-64">
                <canvas id="subscriptionGrowthChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Análises Detalhadas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Top Planos -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Planos por Receita</h3>
            <div class="space-y-4">
                @forelse($topPlans as $index => $plan)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center">
                            <span class="text-sm font-bold text-blue-600">{{ $index + 1 }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $plan->name }}</p>
                            <p class="text-sm text-gray-500">{{ $plan->total_sales_count }} vendas</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900 dark:text-white">R$ {{ number_format($plan->total_revenue, 0, ',', '.') }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i data-lucide="bar-chart-3" class="w-12 h-12 mx-auto mb-4 opacity-50"></i>
                    <p>Nenhum plano encontrado</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Métodos de Pagamento -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Métodos de Pagamento</h3>
            <div class="h-48">
                <canvas id="paymentMethodChart"></canvas>
            </div>
            <div class="mt-4 space-y-2">
                @forelse($revenueByPaymentMethod as $method)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600 dark:text-gray-400 capitalize">{{ str_replace('_', ' ', $method->payment_method) }}</span>
                    <span class="font-medium text-gray-900 dark:text-white">R$ {{ number_format($method->total_revenue, 0, ',', '.') }}</span>
                </div>
                @empty
                <div class="text-center py-4 text-gray-500">
                    <p class="text-sm">Nenhum método encontrado</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Status das Vendas -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status das Vendas</h3>
            <div class="h-48">
                <canvas id="salesStatusChart"></canvas>
            </div>
            <div class="mt-4 space-y-2">
                @forelse($salesByStatus as $status)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600 dark:text-gray-400 capitalize">{{ $status->status }}</span>
                    <div class="text-right">
                        <span class="font-medium text-gray-900 dark:text-white">{{ $status->total }}</span>
                        <span class="text-xs text-gray-500 block">R$ {{ number_format($status->revenue, 0, ',', '.') }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-gray-500">
                    <p class="text-sm">Nenhuma venda encontrada</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

     Análise de Usuários 
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
         Usuários por Perfil 
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Usuários por Perfil</h3>
            <div class="space-y-3">
                @forelse($usersByProfile as $profile)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $profile->profile }}</span>
                    </div>
                    <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $profile->total }}</span>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i data-lucide="users" class="w-12 h-12 mx-auto mb-4 opacity-50"></i>
                    <p>Nenhum usuário encontrado</p>
                </div>
                @endforelse
            </div>
        </div>

         Usuários por Status 
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Usuários por Status</h3>
            <div class="space-y-3">
                @forelse($usersByStatus as $status)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center space-x-3">
                        @php
                            $statusColors = [
                                'ativo' => 'bg-green-500',
                                'inativo' => 'bg-red-500',
                                'pendente' => 'bg-yellow-500'
                            ];
                            $color = $statusColors[$status->status] ?? 'bg-gray-500';
                        @endphp
                        <div class="w-3 h-3 {{ $color }} rounded-full"></div>
                        <span class="font-medium text-gray-900 dark:text-white capitalize">{{ $status->status }}</span>
                    </div>
                    <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $status->total }}</span>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i data-lucide="user-check" class="w-12 h-12 mx-auto mb-4 opacity-50"></i>
                    <p>Nenhum status encontrado</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

     Tabela de Planos Detalhada 
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Desempenho Detalhado dos Planos</h3>
            <button class="text-sm text-blue-600 hover:text-blue-700">Ver Todos</button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white">Plano</th>
                        <th class="text-center py-3 px-4 font-medium text-gray-900 dark:text-white">Vendas</th>
                        <th class="text-center py-3 px-4 font-medium text-gray-900 dark:text-white">Assinantes Ativos</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-900 dark:text-white">Receita Total</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-900 dark:text-white">Preço Médio</th>
                        <th class="text-center py-3 px-4 font-medium text-gray-900 dark:text-white">Performance</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salesByPlan as $plan)
                    <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="py-3 px-4">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $plan->name }}</div>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm">
                                {{ $plan->total_sales_count }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @php
                                $activeCount = $activeSubscriptionsByPlan->where('name', $plan->name)->first()->active_count ?? 0;
                            @endphp
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">
                                {{ $activeCount }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-right font-medium text-gray-900 dark:text-white">
                            R$ {{ number_format($plan->total_revenue, 2, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 text-right text-gray-600 dark:text-gray-400">
                            R$ {{ number_format($plan->average_price, 2, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            @php
                                $performance = $totalRevenue > 0 ? ($plan->total_revenue / $totalRevenue) * 100 : 0;
                            @endphp
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min($performance, 100) }}%"></div>
                            </div>
                            <span class="text-xs text-gray-500 mt-1">{{ number_format($performance, 1) }}%</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500">
                            <i data-lucide="package" class="w-12 h-12 mx-auto mb-4 opacity-50"></i>
                            <p>Nenhum plano encontrado</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();

    // Dados do backend
    const revenueGrowthData = @json($revenueGrowthChart);
    const subscriptionGrowthData = @json($subscriptionGrowth);
    const revenueByPaymentMethodData = @json($revenueByPaymentMethod);
    const salesByStatusData = @json($salesByStatus);

    // Configurações globais dos gráficos
    Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
    Chart.defaults.color = '#6B7280';

    // Gráfico de Crescimento de Receita
    if (revenueGrowthData.length > 0) {
        const revenueCtx = document.getElementById('revenueGrowthChart');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueGrowthData.map(d => {
                    const [year, month] = d.month_year.split('-');
                    return new Date(year, month - 1).toLocaleDateString('pt-BR', { month: 'short', year: '2-digit' });
                }),
                datasets: [{
                    label: 'Receita Mensal',
                    data: revenueGrowthData.map(d => d.monthly_revenue),
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#3B82F6',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#3B82F6',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return 'Receita: R$ ' + new Intl.NumberFormat('pt-BR').format(context.parsed.y);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + new Intl.NumberFormat('pt-BR', { notation: 'compact' }).format(value);
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Gráfico de Crescimento de Assinantes (mudando para linha)
    if (subscriptionGrowthData.length > 0) {
        const subscriptionCtx = document.getElementById('subscriptionGrowthChart');
        new Chart(subscriptionCtx, {
            type: 'line',
            data: {
                labels: subscriptionGrowthData.map(d => {
                    const [year, month] = d.month_year.split('-');
                    return new Date(year, month - 1).toLocaleDateString('pt-BR', { month: 'short', year: '2-digit' });
                }),
                datasets: [{
                    label: 'Novas Assinaturas',
                    data: subscriptionGrowthData.map(d => d.new_subs),
                    borderColor: '#22C55E',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#22C55E',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#22C55E',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return 'Novas Assinaturas: ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Gráfico de Métodos de Pagamento
    if (revenueByPaymentMethodData.length > 0) {
        const paymentCtx = document.getElementById('paymentMethodChart');
        new Chart(paymentCtx, {
            type: 'doughnut',
            data: {
                labels: revenueByPaymentMethodData.map(d => {
                    const methods = {
                        'credit_card': 'Cartão de Crédito',
                        'pix': 'PIX',
                        'boleto': 'Boleto'
                    };
                    return methods[d.payment_method] || d.payment_method;
                }),
                datasets: [{
                    data: revenueByPaymentMethodData.map(d => d.total_revenue),
                    backgroundColor: [
                        '#3B82F6',
                        '#22C55E', 
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return context.label + ': R$ ' + new Intl.NumberFormat('pt-BR').format(context.parsed) + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // Gráfico de Status das Vendas
    if (salesByStatusData.length > 0) {
        const salesStatusCtx = document.getElementById('salesStatusChart');
        new Chart(salesStatusCtx, {
            type: 'pie',
            data: {
                labels: salesByStatusData.map(d => {
                    const statuses = {
                        'paid': 'Pago',
                        'awaiting_payment': 'Pendente',
                        'canceled': 'Cancelado',
                        'failed': 'Falhou'
                    };
                    return statuses[d.status] || d.status;
                }),
                datasets: [{
                    data: salesByStatusData.map(d => d.total),
                    backgroundColor: [
                        '#22C55E',
                        '#F59E0B',
                        '#EF4444',
                        '#6B7280'
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                }
            }
        });
    }
});

// Funções de exportação
function exportPdf() {
    fetch('/associacao/relatorios/export-pdf', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    });
}

function exportExcel() {
    fetch('/associacao/relatorios/export-excel', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    });
}

function toggleChart(type, period) {
    // TODO: Implementar filtros de período
    console.log('Toggle chart:', type, period);
}
</script>
@endpush
