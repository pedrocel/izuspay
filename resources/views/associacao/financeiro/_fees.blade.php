<div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl">
    {{-- Cabeçalho da Seção --}}
    <div class="px-6 py-4 border-b border-white/10">
        <h3 class="text-lg font-semibold text-white flex items-center">
            <i data-lucide="percent" class="w-5 h-5 mr-2 text-blue-400"></i>
            Sua Estrutura de Taxas
        </h3>
    </div>

    {{-- Lista de Taxas Dinâmicas --}}
    <div class="p-6">
        <div class="space-y-4">
            @php
                // Mapeia os nomes e ícones para cada método de pagamento
                $feeDetailsMap = [
                    'pix' => ['title' => 'Taxa por Venda (PIX)', 'icon' => 'mouse-pointer-click'],
                    'credit_card' => ['title' => 'Taxa por Venda (Cartão de Crédito)', 'icon' => 'credit-card'],
                    'boleto' => ['title' => 'Taxa por Venda (Boleto)', 'icon' => 'barcode'],
                ];
            @endphp

            @forelse ($fees as $fee)
                @php
                    // Pega os detalhes do mapa ou usa um padrão
                    $details = $feeDetailsMap[$fee->payment_method] ?? ['title' => 'Taxa por Venda (' . ucfirst($fee->payment_method) . ')', 'icon' => 'receipt'];
                    
                    // Formata o valor da taxa para exibição
                    $formattedValue = '';
                    if ($fee->percentage_fee > 0) {
                        $formattedValue .= number_format($fee->percentage_fee, 2, ',', '.') . '%';
                    }
                    if ($fee->fixed_fee > 0) {
                        if (!empty($formattedValue)) {
                            $formattedValue .= ' + ';
                        }
                        $formattedValue .= 'R$ ' . number_format($fee->fixed_fee, 2, ',', '.');
                    }
                    if (empty($formattedValue)) {
                        $formattedValue = 'Isento';
                    }
                @endphp

                <div class="bg-slate-900/70 border border-white/10 rounded-xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-black/20 border border-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-lucide="{{ $details['icon'] }}" class="w-6 h-6 text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $details['title'] }}</p>
                            <p class="text-xs text-gray-400">Aplicada sobre o valor de cada venda concluída com este método.</p>
                        </div>
                    </div>
                    <div class="bg-blue-900/50 border border-blue-500/30 rounded-lg px-4 py-2 text-center self-end sm:self-center flex-shrink-0">
                        <p class="text-sm font-bold text-cyan-300">{{ $formattedValue }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i data-lucide="alert-circle" class="w-12 h-12 mx-auto text-gray-500"></i>
                    <p class="mt-4 text-sm text-gray-400">Nenhuma estrutura de taxas foi configurada para sua conta.</p>
                </div>
            @endforelse

            {{-- Você ainda pode adicionar taxas fixas estáticas aqui, se desejar --}}
            <div class="bg-slate-900/70 border border-white/10 rounded-xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-black/20 border border-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i data-lucide="arrow-down-up" class="w-6 h-6 text-gray-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Taxa de Saque (por solicitação)</p>
                        <p class="text-xs text-gray-400">Valor fixo cobrado para processar cada solicitação de saque.</p>
                    </div>
                </div>
                <div class="bg-blue-900/50 border border-blue-500/30 rounded-lg px-4 py-2 text-center self-end sm:self-center flex-shrink-0">
                    <p class="text-sm font-bold text-cyan-300">R$ 5,00</p>
                </div>
            </div>
        </div>
    </div>
</div>
