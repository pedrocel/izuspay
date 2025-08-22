<div class="max-w-xl mx-auto space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Conteúdo do Contrato</h3>
        <div class="prose max-w-none dark:prose-invert" style="max-height: 500px; overflow-y: auto; border: 1px solid #e5e7eb; padding: 1rem; border-radius: 0.5rem;">
            <p><strong>Cláusula 1: Objeto do Contrato</strong></p>
            <p>O presente contrato tem por objeto regular a associação do {{ auth()->user()->name }} à sua associação, a partir da data de {{ now()->format('d/m/Y') }}...</p>
            <p>Este contrato de adesão é eletrônico e constitui um acordo legal entre você e a associação.</p>
            </div>
        
        <form action="{{ route('cliente.contrato.sign') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div class="flex items-center">
                <input type="checkbox" id="aceite" name="aceite" required
                       class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                <label for="aceite" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Li e concordo com os termos e condições do contrato.
                </label>
            </div>
            <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Assinar e Ativar Associação
            </button>
        </form>
    </div>
</div>