<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Realizada com Sucesso!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        
        <!-- Success Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-green-600 text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Compra Realizada com Sucesso!</h1>
            <p class="text-gray-600">Obrigado por escolher nossos serviços</p>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Detalhes da Compra</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Customer Info -->
                <div>
                    <h3 class="font-medium text-gray-900 mb-3">Dados do Cliente</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nome:</span>
                            <span class="font-medium">{{ $sale->user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">E-mail:</span>
                            <span class="font-medium">{{ $sale->user->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Telefone:</span>
                            <span class="font-medium">{{ $sale->user->telefone }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Plan Info -->
                <div>
                    <h3 class="font-medium text-gray-900 mb-3">Plano Adquirido</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Plano:</span>
                            <span class="font-medium">{{ $sale->plan->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Recorrência:</span>
                            <span class="font-medium capitalize">{{ $sale->plan->recurrence }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Valor:</span>
                            <span class="font-medium text-primary-600">R$ {{ number_format($sale->total_price, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Status do Pagamento</h2>
            
            <div class="flex items-center justify-between p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-clock text-yellow-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-yellow-800">Aguardando Pagamento</p>
                        <p class="text-sm text-yellow-600">Método: {{ ucfirst(str_replace('_', ' ', $sale->payment_method)) }}</p>
                    </div>
                </div>
                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                    Pendente
                </span>
            </div>
            
            @if($sale->payment_method === 'pix')
                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-blue-800 font-medium mb-2">Instruções para pagamento PIX:</p>
                    <p class="text-blue-700 text-sm">O código PIX será enviado para seu e-mail em alguns minutos.</p>
                </div>
            @elseif($sale->payment_method === 'boleto')
                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-blue-800 font-medium mb-2">Instruções para pagamento do Boleto:</p>
                    <p class="text-blue-700 text-sm">O boleto será enviado para seu e-mail e tem vencimento em 3 dias úteis.</p>
                </div>
            @endif
        </div>

        <!-- Next Steps -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Próximos Passos</h2>
            
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                        <span class="text-primary-600 text-sm font-semibold">1</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Confirmação por E-mail</p>
                        <p class="text-sm text-gray-600">Você receberá um e-mail com os detalhes da compra e instruções de pagamento.</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                        <span class="text-primary-600 text-sm font-semibold">2</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Processamento do Pagamento</p>
                        <p class="text-sm text-gray-600">Após a confirmação do pagamento, seu acesso será liberado automaticamente.</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                        <span class="text-primary-600 text-sm font-semibold">3</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Acesso Liberado</p>
                        <p class="text-sm text-gray-600">Você receberá suas credenciais de acesso por e-mail.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mt-8 justify-center">
            <a href="/" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors text-center">
                <i class="fas fa-home mr-2"></i>
                Voltar ao Início
            </a>
            <a href="mailto:suporte@exemplo.com" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg transition-colors text-center">
                <i class="fas fa-envelope mr-2"></i>
                Contatar Suporte
            </a>
        </div>
    </div>
</body>
</html>
