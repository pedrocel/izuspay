<div>
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Solicitar Saque</h3>
        </div>
        <form method="POST" action="{{ route('associacao.financeiro.withdrawals.store') }}" class="p-6 space-y-4">
            @csrf
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Valor do Saque</label>
                <input type="number" name="amount" id="amount" step="0.01" min="1" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('amount') border-red-500 @enderror">
                @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="bank_account_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Conta Bancária</label>
                <select name="bank_account_id" id="bank_account_id" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('bank_account_id') border-red-500 @enderror">
                    <option value="">Selecione uma conta</option>
                    @forelse($bankAccounts as $account)
                        <option value="{{ $account->id }}">{{ $account->bank_name }} - {{ $account->account_number }}</option>
                    @empty
                        <option value="" disabled>Nenhuma conta cadastrada</option>
                    @endforelse
                </select>
                @error('bank_account_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                    Solicitar Saque
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Histórico de Saques</h3>
        </div>
        <div class="p-6">
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($withdrawals as $withdrawal)
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Saque de R$ {{ number_format($withdrawal->amount, 2, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Conta: {{ $withdrawal->bankAccount->bank_name }} - {{ $withdrawal->bankAccount->account_number }}</p>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $withdrawal->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($withdrawal->status) }}
                        </span>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $withdrawal->created_at->diffForHumans() }}</p>
                    </div>
                </li>
                @empty
                <li class="py-4 text-center text-gray-500 dark:text-gray-400">Nenhum saque solicitado.</li>
                @endforelse
            </ul>
            @if($withdrawals->hasPages())
                <div class="mt-4">
                    {{ $withdrawals->links() }}
                </div>
            @endif
        </div>
    </div>
</div>