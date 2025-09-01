<div class="overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ID Venda</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Cliente</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Item</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Valor</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Data</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($sales as $sale)
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $sale->id }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $sale->user->name }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $sale->product->name ?? $sale->plan->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">R$ {{ number_format($sale->total_price, 2, ',', '.') }}</td>
                    <td class="px-4 py-3">{!! $sale->getStatusBadge() !!}</td>
                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $sale->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500 dark:text-gray-400">Nenhuma venda encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
