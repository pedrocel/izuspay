<div class="overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700/50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nome do Produto</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Preço</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Vendas</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($products as $product)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td class="px-4 py-3">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $product->hash_id }}</div>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        R$ {{ number_format($product->price, 2, ',', '.') }}
                    </td>
                    <td class="px-4 py-3">
                        @if($product->is_active)
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                Ativo
                            </span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400">
                                Inativo
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-right text-gray-500 dark:text-gray-400">
                        {{-- Para contar as vendas, precisamos do relacionamento no model Product --}}
                        {{ $product->sales->count() }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center">
                            <i data-lucide="package" class="w-10 h-10 mb-2 text-gray-400"></i>
                            Nenhum produto encontrado para esta conta.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
