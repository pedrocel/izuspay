{{-- resources/views/associacao/financeiro/_withdrawals.blade.php --}}

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Coluna da Esquerda: Formulário de Saque --}}
    <div class="lg:col-span-1 space-y-8">
        <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl">
            {{-- Cabeçalho --}}
            <div class="px-6 py-4 border-b border-white/10">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <i data-lucide="arrow-down-up" class="w-5 h-5 mr-2 text-blue-400"></i>
                    Solicitar Saque
                </h3>
            </div>

            {{-- Formulário --}}
            <form method="POST" action="{{ route('associacao.financeiro.withdrawals.store') }}" class="p-6 space-y-6">
                @csrf
                
                {{-- Saldo Disponível --}}
                <div class="bg-slate-900/70 border border-white/10 rounded-xl p-4 text-center">
                    <p class="text-sm font-medium text-gray-400">Saldo Disponível para Saque</p>
                    <p class="text-3xl font-bold text-green-400 mt-1">R$ {{ number_format($wallet->balance, 2, ',', '.') }}</p>
                </div>

                {{-- Campo de Valor --}}
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-300 mb-1">Valor do Saque *</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">R$</span>
                        <input type="number" name="amount" id="amount" step="0.01" min="1" required
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('amount') border-red-500 @enderror">
                    </div>
                    @error('amount') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Campo de Conta Bancária --}}
                <div>
                    <label for="bank_account_id" class="block text-sm font-medium text-gray-300 mb-1">Conta Bancária de Destino *</label>
                    <select name="bank_account_id" id="bank_account_id" required
                            class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('bank_account_id') border-red-500 @enderror">
                        <option value="">Selecione uma conta</option>
                        @forelse($bankAccounts as $account)
                            <option value="{{ $account->id }}" {{ $account->is_default ? 'selected' : '' }}>
                                {{ $account->bank_name }} (Final {{ substr($account->account_number, -4) }})
                            </option>
                        @empty
                            <option value="" disabled>Nenhuma conta cadastrada</option>
                        @endforelse
                    </select>
                    @error('bank_account_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Botão de Ação --}}
                <div class="pt-2">
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-xl hover:from-blue-600 hover:to-cyan-700 transition-all font-semibold shadow-lg hover:shadow-blue-500/30">
                        Confirmar Solicitação
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Coluna da Direita: Histórico de Saques --}}
    <div class="lg:col-span-2 bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl">
        <div class="px-6 py-4 border-b border-white/10">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <i data-lucide="history" class="w-5 h-5 mr-2 text-blue-400"></i>
                Histórico de Saques
            </h3>
        </div>
        
        <div class="p-6 space-y-4">
            @forelse($withdrawals as $withdrawal)
                @php
                    $statusMap = [
                        'pending' => ['icon' => 'hourglass', 'color' => 'yellow', 'text' => 'Pendente'],
                        'completed' => ['icon' => 'check-circle', 'color' => 'green', 'text' => 'Concluído'],
                        'failed' => ['icon' => 'x-circle', 'color' => 'red', 'text' => 'Falhou'],
                    ];
                    $statusInfo = $statusMap[$withdrawal->status] ?? ['icon' => 'help-circle', 'color' => 'gray', 'text' => ucfirst($withdrawal->status)];
                @endphp
                <div class="bg-slate-900/70 border border-white/10 rounded-xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-black/20 border border-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-lucide="arrow-right" class="w-6 h-6 text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Saque de R$ {{ number_format($withdrawal->amount, 2, ',', '.') }}</p>
                            <p class="text-xs text-gray-400">Para: {{ $withdrawal->bankAccount->bank_name }} (Final {{ substr($withdrawal->bankAccount->account_number, -4) }})</p>
                        </div>
                    </div>
                    <div class="text-right self-end sm:self-center flex-shrink-0">
                        <span class="flex items-center px-3 py-1 text-xs font-medium bg-{{ $statusInfo['color'] }}-900/50 text-{{ $statusInfo['color'] }}-300 border border-{{ $statusInfo['color'] }}-500/30 rounded-full">
                            <i data-lucide="{{ $statusInfo['icon'] }}" class="w-3 h-3 mr-1.5"></i>
                            {{ $statusInfo['text'] }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1.5">{{ $withdrawal->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-slate-700/50 border border-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="history" class="w-8 h-8 text-blue-400"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-1">Nenhum saque solicitado</h4>
                    <p class="text-gray-400 text-sm">Seu histórico de saques aparecerá aqui.</p>
                </div>
            @endforelse

            @if($withdrawals->hasPages())
                <div class="mt-6">
                    {{ $withdrawals->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
