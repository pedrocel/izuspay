<div>
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Minhas Contas Bancárias</h3>
            <a href="{{ route('associacao.financeiro.bank-accounts.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                <i data-lucide="plus" class="w-4 h-4 inline mr-2"></i> Adicionar Conta
            </a>
        </div>
        <div class="p-6">
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($bankAccounts as $account)
                <li class="py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <i data-lucide="banknote" class="w-5 h-5 text-gray-600 dark:text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $account->bank_name }} - Ag. {{ $account->agency }} / Cc. {{ $account->account_number }}</p>
                            @if($account->pix_key)
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Chave Pix ({{ ucfirst($account->pix_key_type) }}): {{ $account->pix_key }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($account->is_default)
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Padrão</span>
                        @endif
                        <a href="{{ route('associacao.financeiro.bank-accounts.edit', $account) }}" class="text-blue-600 hover:text-blue-900">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </a>
                        <form method="POST" action="{{ route('associacao.financeiro.bank-accounts.destroy', $account) }}" class="inline-block" onsubmit="return confirm('Excluir esta conta?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </li>
                @empty
                <li class="py-4 text-center text-gray-500 dark:text-gray-400">Nenhuma conta bancária cadastrada.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>