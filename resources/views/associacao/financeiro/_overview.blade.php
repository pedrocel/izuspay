<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Saldo Disponível</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($wallet->balance, 2, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                <i data-lucide="wallet" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Receita Total</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                <i data-lucide="bar-chart-2" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Saques Pendentes</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($pendingWithdrawals, 2, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/20 rounded-lg flex items-center justify-center">
                <i data-lucide="credit-card" class="w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Vendas Pendentes</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($pendingRevenue, 2, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-red-100 dark:bg-red-900/20 rounded-lg flex items-center justify-center">
                <i data-lucide="clock" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
            </div>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Vendas Recentes</h3>
    </div>
    <div class="p-6">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($recentSales as $sale)
            <li class="py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                            <i data-lucide="credit-card" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                Venda do Plano: {{ $sale->plan->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Cliente: {{ $sale->user->name }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-green-600">
                            + R$ {{ number_format($sale->total_price, 2, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $sale->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </li>
            @empty
            <li class="py-4 text-center text-gray-500 dark:text-gray-400">
                Nenhuma venda recente.
            </li>
            @endforelse
        </ul>
    </div>
</div>