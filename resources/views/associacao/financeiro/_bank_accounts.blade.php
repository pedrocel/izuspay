{{-- resources/views/associacao/financeiro/_bank_accounts.blade.php --}}

<div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl">
    {{-- Cabeçalho da Seção --}}
    <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-white flex items-center">
            <i data-lucide="landmark" class="w-5 h-5 mr-2 text-blue-400"></i>
            Minhas Contas Bancárias
        </h3>
        <a href="{{ route('associacao.financeiro.bank-accounts.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-500 to-cyan-600 hover:from-blue-600 hover:to-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all shadow-lg hover:shadow-blue-500/20">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Adicionar Conta</span>
        </a>
    </div>

    {{-- Lista de Contas Bancárias --}}
    <div class="p-6">
        @if($bankAccounts->isNotEmpty())
            <div class="space-y-4">
                @foreach($bankAccounts as $account)
                <div class="bg-slate-900/70 border border-white/10 rounded-xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:border-blue-500/50 hover:-translate-y-0.5 transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-black/20 border border-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-lucide="banknote" class="w-6 h-6 text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $account->bank_name }}</p>
                            <p class="text-sm text-gray-300">Ag. {{ $account->agency }} / Conta {{ $account->account_number }}</p>
                            @if($account->pix_key)
                                <p class="text-xs text-gray-400 mt-1">
                                    <span class="font-medium text-cyan-400">PIX ({{ ucfirst(str_replace('_', ' ', $account->pix_key_type)) }}):</span> {{ $account->pix_key }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 self-end sm:self-center flex-shrink-0">
                        @if($account->is_default)
                            <span class="flex items-center px-3 py-1 text-xs font-medium bg-green-900/50 text-green-300 border border-green-500/30 rounded-full">
                                <i data-lucide="check-circle" class="w-3 h-3 mr-1.5"></i>
                                Padrão
                            </span>
                        @else
                            {{-- Formulário para definir como padrão --}}
                            <form method="POST" action="{{ route('associacao.financeiro.bank-accounts.set-default', $account) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="p-2 text-gray-400 hover:text-green-400 bg-slate-700/50 hover:bg-slate-700 rounded-md transition-colors" title="Definir como Padrão">
                                    <i data-lucide="star" class="w-5 h-5"></i>
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('associacao.financeiro.bank-accounts.edit', $account) }}" class="p-2 text-gray-400 hover:text-blue-400 bg-slate-700/50 hover:bg-slate-700 rounded-md transition-colors" title="Editar">
                            <i data-lucide="edit" class="w-5 h-5"></i>
                        </a>
                        
                        <form method="POST" action="{{ route('associacao.financeiro.bank-accounts.destroy', $account) }}" onsubmit="return confirm('Tem certeza que deseja excluir esta conta bancária?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-400 bg-slate-700/50 hover:bg-slate-700 rounded-md transition-colors" title="Excluir">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            {{-- Estado Vazio --}}
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-slate-700/50 border border-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="landmark" class="w-8 h-8 text-blue-400"></i>
                </div>
                <h4 class="text-lg font-semibold text-white mb-1">Nenhuma conta bancária cadastrada</h4>
                <p class="text-gray-400 text-sm mb-4">Adicione sua primeira conta para poder realizar saques.</p>
                <a href="{{ route('associacao.financeiro.bank-accounts.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-500 to-cyan-600 hover:from-blue-600 hover:to-cyan-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-all shadow-lg hover:shadow-blue-500/20">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Adicionar Primeira Conta</span>
                </a>
            </div>
        @endif
    </div>
</div>
