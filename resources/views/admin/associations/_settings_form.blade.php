<form action="{{ route('admin.associations.updateSettings', $association) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Seção de Configuração do Gateway -->
    <div class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Gateway de Pagamento</h4>
        <div>
            <label for="gateway_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Adquirente Ativa</label>
            <select id="gateway_id" name="gateway_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:bg-gray-900 dark:text-white">
                <option value="">Nenhum (Usar Padrão da Plataforma)</option>
                @foreach($availableGateways as $gateway)
                    <option value="{{ $gateway->id }}" @selected($association->wallet->gateway_id == $gateway->id)>
                        {{ $gateway->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Seção de Edição de Taxas -->
    <div class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Taxas de Transação</h4>
        <div class="space-y-4">
            @foreach($association->fees as $fee)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label class="font-medium text-gray-700 dark:text-gray-300 md:col-span-1">
                        Taxa para {{ ucfirst($fee->payment_method) }}
                    </label>
                    <div class="md:col-span-2 grid grid-cols-2 gap-4">
                        <div>
                            <label for="fee_{{ $fee->id }}_percentage" class="text-xs text-gray-500 dark:text-gray-400">Porcentagem (%)</label>
                            <input type="text" id="fee_{{ $fee->id }}_percentage" name="fees[{{ $fee->id }}][percentage_fee]" 
                                   value="{{ old('fees.'.$fee->id.'.percentage_fee', $fee->percentage_fee) }}"
                                   class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-900 dark:text-white">
                        </div>
                        <div>
                            <label for="fee_{{ $fee->id }}_fixed" class="text-xs text-gray-500 dark:text-gray-400">Taxa Fixa (R$)</label>
                            <input type="text" id="fee_{{ $fee->id }}_fixed" name="fees[{{ $fee->id }}][fixed_fee]" 
                                   value="{{ old('fees.'.$fee->id.'.fixed_fee', $fee->fixed_fee) }}"
                                   class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-900 dark:text-white">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Botão de Salvar -->
    <div class="flex justify-end mt-6">
        <button type="submit" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
            <i data-lucide="save" class="w-4 h-4 mr-2"></i>
            Salvar Configurações
        </button>
    </div>
</form>
