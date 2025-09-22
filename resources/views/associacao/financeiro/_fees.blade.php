{{-- resources/views/associacao/financeiro/_fees.blade.php --}}

<div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl">
    {{-- Cabeçalho da Seção --}}
    <div class="px-6 py-4 border-b border-white/10">
        <h3 class="text-lg font-semibold text-white flex items-center">
            <i data-lucide="percent" class="w-5 h-5 mr-2 text-blue-400"></i>
            Estrutura de Taxas
        </h3>
    </div>

    {{-- Lista de Taxas --}}
    <div class="p-6">
        <div class="space-y-4">
            @php
                $fees = [
                    [
                        'title' => 'Taxa da Plataforma (por venda)',
                        'description' => 'Aplicada sobre o valor de cada venda concluída com sucesso.',
                        'value' => '2.99% + R$ 0,50',
                        'icon' => 'receipt'
                    ],
                    [
                        'title' => 'Taxa de Saque (por solicitação)',
                        'description' => 'Valor fixo cobrado para processar cada solicitação de saque para sua conta.',
                        'value' => 'R$ 5,00',
                        'icon' => 'arrow-down-up'
                    ],
                    [
                        'title' => 'Valor Mínimo para Saque',
                        'description' => 'Você precisa ter este valor como saldo disponível para solicitar um saque.',
                        'value' => 'R$ 50,00',
                        'icon' => 'wallet'
                    ]
                ];
            @endphp

            @foreach ($fees as $fee)
            <div class="bg-slate-900/70 border border-white/10 rounded-xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-black/20 border border-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i data-lucide="{{ $fee['icon'] }}" class="w-6 h-6 text-gray-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $fee['title'] }}</p>
                        <p class="text-xs text-gray-400">{{ $fee['description'] }}</p>
                    </div>
                </div>
                <div class="bg-blue-900/50 border border-blue-500/30 rounded-lg px-4 py-2 text-center self-end sm:self-center flex-shrink-0">
                    <p class="text-sm font-bold text-cyan-300">{{ $fee['value'] }}</p>
                </div>
            </div>
            @endforeach
        </ul>
    </div>
</div>
