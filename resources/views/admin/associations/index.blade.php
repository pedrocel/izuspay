@extends('layouts.app')

@section('title', 'Contas - Administração')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-lg">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center shadow-md">
                        <i data-lucide="building" class="w-6 h-6 text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Contas cadastradas na plataforma</h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Gerencie todas as contas (associações) da plataforma</p>
            </div>
            <div class="flex items-center space-x-3">
                <button class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i data-lucide="search" class="w-4 h-4 mr-2"></i>
                    PESQUISAR
                </button>
                <button class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
                    FILTRO
                </button>
                <button class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                    EXPORTAR LISTA
                </button>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Período</label>
                <input type="text" placeholder="1 de Ago, 2025 até 29 de Ago, 2025" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dados do recebedor ou usuário</label>
                <input type="text" placeholder="Nome, email, documento..." class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                    <option value="">Todos</option>
                    <option value="ativa">Ativo</option>
                    <option value="inativa">Inativo</option>
                    <option value="pendente">Pendente</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="w-full px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    Modo Analítico
                </button>
            </div>
        </div>
    </div>

  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                {{-- Cabeçalho da tabela com a cor padrão e nova coluna --}}
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Titular da Conta
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Taxas por M. Pagamento
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Saldo Disponível
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Cadastro
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($associations as $association)
                    @php
                            // Chamamos o accessor uma vez para evitar recalcular
                            $balanceDetails = $association->balance_details;
                        @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        {{-- Coluna Titular da Conta --}}
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.contas.show', $association) }}" class="hover:underline">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $association->creatorProfile->profile_image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($association->nome ) . '&background=22c55e&color=fff&size=200' }}" alt="Logo">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $association->nome }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $association->documento_formatado }}</div>
                                    </div>
                                </div>
                            </a>
                        </td>

                        {{-- NOVA COLUNA DE TAXAS --}}
                        <td class="px-6 py-4">
                            <div class="flex flex-col space-y-2 text-sm">
                                @foreach($association->fee_details as $fee)
                                    <div>
                                        <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $fee['label'] }}:</span>
                                        <span class="text-gray-600 dark:text-gray-400">
                                            {{ $fee['fee_percentage'] }}% + R$ {{ number_format($fee['fee_fixed'], 2, ',', '.') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </td>

                        {{-- Coluna Saldo Disponível --}}
                        <td class="px-6 py-4">
                                <div class="text-sm space-y-1">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Disponível:</span>
                                        <span class="font-medium text-green-600 dark:text-green-400">R$ {{ number_format($balanceDetails['available'], 2, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Aguard. Liberação:</span>
                                        <span>R$ {{ number_format($balanceDetails['pending_release'], 2, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Aguard. Saque:</span>
                                        <span>R$ {{ number_format($balanceDetails['pending_withdrawal'], 2, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Transferido:</span>
                                        <span>R$ {{ number_format($balanceDetails['total_withdrawn'], 2, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Retido:</span>
                                        <span class="text-red-600 dark:text-red-400">R$ {{ number_format($balanceDetails['retained'], 2, ',', '.') }}</span>
                                    </div>
                                    <div class="text-xs text-gray-400 mt-2">
                                        Total Bruto: R$ {{ number_format($balanceDetails['total_gross'], 2, ',', '.') }}
                                    </div>
                                </div>
                            </td>

                        {{-- Coluna Status --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            {!! $association->getBadgeStatus() !!}
                        </td>

                        {{-- Coluna Cadastro --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $association->created_at->format('d/m/Y') }}
                        </td>

                        {{-- Coluna Ações --}}
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.contas.show', $association) }}" class="text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300">
                                Detalhes
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i data-lucide="building" class="w-12 h-12 text-gray-400 mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nenhuma conta encontrada</h3>
                                <p class="text-gray-500 dark:text-gray-400">Nenhuma associação corresponde aos filtros aplicados.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($associations->hasPages())
        <div class="bg-white dark:bg-gray-800 px-6 py-3 border-t border-gray-200 dark:border-gray-700">
            {{ $associations->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>
@endpush
@endsection

