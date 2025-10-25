<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Realizada com Sucesso!</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 min-h-screen">
    
    <div class="container mx-auto px-4 py-12 max-w-2xl">
        
        <!-- Card de Sucesso -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Header com Ícone -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-8 text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Pagamento Confirmado!</h1>
                <p class="text-green-100">Seus bilhetes foram reservados com sucesso</p>
            </div>

            <!-- Conteúdo -->
            <div class="p-8">
                
                <!-- Informações da Compra -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Detalhes da Compra</h2>
                    
                    <div class="bg-gray-50 rounded-lg p-6 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Rifa:</span>
                            <span class="font-semibold text-gray-800">{{ $sale->raffle->title }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Comprador:</span>
                            <span class="font-semibold text-gray-800">{{ $sale->buyer_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Telefone:</span>
                            <span class="font-semibold text-gray-800">{{ $sale->buyer_phone }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Quantidade:</span>
                            <span class="font-semibold text-gray-800">{{ $sale->quantity }} bilhete(s)</span>
                        </div>
                        <div class="flex justify-between border-t pt-3">
                            <span class="text-gray-600 font-medium">Total Pago:</span>
                            <span class="font-bold text-green-600 text-xl">R$ {{ number_format($sale->total_price, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Números da Sorte -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">🎫 Seus Números da Sorte</h2>
                    
                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                        @foreach($sale->tickets as $ticket)
                        <div class="bg-gradient-to-br from-purple-500 to-pink-500 text-white rounded-lg p-4 text-center shadow-lg">
                            <div class="text-2xl font-bold">{{ str_pad($ticket->number, 4, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Informações Importantes -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <h3 class="font-semibold text-blue-900 mb-3">📌 Informações Importantes:</h3>
                    <ul class="text-sm text-blue-800 space-y-2">
                        <li>✓ Seus números foram registrados com sucesso</li>
                        <li>✓ Você receberá uma confirmação no WhatsApp/telefone cadastrado</li>
                        <li>✓ Guarde este comprovante para consultas futuras</li>
                        <li>✓ O sorteio será realizado na data informada na rifa</li>
                    </ul>
                </div>

                <!-- Botões de Ação -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('raffles.index') }}" 
                       class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-3 rounded-lg text-center transition-all duration-200">
                        Ver Outras Rifas
                    </a>
                    <a href="{{ route('raffles.show', $sale->raffle->hash_id) }}" 
                       class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 rounded-lg text-center transition-all duration-200">
                        Voltar para a Rifa
                    </a>
                </div>

                <!-- Compartilhar -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600 mb-3">Compartilhe com seus amigos!</p>
                    <div class="flex justify-center gap-3">
                        <a href="https://wa.me/?text=Acabei de comprar bilhetes na rifa {{ $sale->raffle->title }}! Participe você também!" 
                           target="_blank"
                           class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium">
                            WhatsApp
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- ID da Venda -->
        <p class="text-center text-gray-500 text-sm mt-6">
            ID da Compra: {{ $sale->id }}
        </p>

    </div>

</body>
</html>
