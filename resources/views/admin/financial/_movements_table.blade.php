<div class="overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700/50">
            <tr>
                <th class="p-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Transação</th>
                <th class="p-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tipo</th>
                <th class="p-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Valor</th>
                <th class="p-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Data</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($movements as $movement)
                <tr>
                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">#{{ $movement->id }}</td>
                    <td class="p-4">
                        @if($movement->type == 'sale')
                            <span class="font-semibold text-green-600 dark:text-green-400">Entrada (Venda)</span>
                        @else
                            <span class="font-semibold text-red-600 dark:text-red-400">Saída (Saque)</span>
                        @endif
                    </td>
                    <td class="p-4 font-semibold text-gray-900 dark:text-white">R$ {{ number_format($movement->amount, 2, ',', '.') }}</td>
                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-12 text-gray-500 dark:text-gray-400">Nenhuma movimentação encontrada.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
