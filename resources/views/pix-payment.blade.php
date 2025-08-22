<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento PIX - {{ $planName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .pix-code-container {
            background: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 12px;
            font-family: monospace;
            font-size: 14px;
            word-break: break-all;
            margin-top: 16px;
            position: relative;
        }
        .copy-btn {
            background: #059669; /* green-600 */
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 12px;
        }
        .copy-btn:hover {
            background: #047857; /* green-700 */
        }
        .payment-status-box {
            background: #f0f9ff; /* blue-50 */
            border: 1px solid #0ea5e9; /* sky-500 */
            color: #0c4a6e; /* sky-900 */
            border-radius: 8px;
            padding: 16px;
            margin-top: 24px;
            text-align: center;
        }
        .payment-status-box.paid {
            background: #ecfdf5; /* green-50 */
            border-color: #10b981; /* green-500 */
            color: #065f46; /* green-900 */
        }
        .notification-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #10b981; /* green-500 */
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .notification-message.show {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Pagamento via PIX</h1>
            <p class="text-gray-600">Finalize sua compra do plano **{{ $planName }}**</p>
            <p class="text-3xl font-extrabold text-green-600 mt-4">
                R$ {{ number_format($totalPrice / 100, 2, ',', '.') }} {{-- Divide por 100 para converter centavos para reais --}}
            </p>
        </div>

        <div class="text-center">
            <p class="text-gray-700 mb-4">Escaneie o QR Code com o app do seu banco:</p>
            <div class="w-48 h-48 mx-auto border border-gray-300 rounded-lg flex items-center justify-center overflow-hidden">
                <img src="{{ $pixQrCodeImage }}" alt="QR Code PIX" class="w-full h-full object-contain">
            </div>

            <p class="text-gray-700 mt-6 mb-2">Ou copie e cole o código PIX:</p>
            <div class="pix-code-container">
                <span id="pixCode">{{ $pixQrCode }}</span>
            </div>
            <button onclick="copyPixCode()" class="copy-btn">
                <i class="fas fa-copy mr-2"></i>
                Copiar Código PIX
            </button>

            <div id="paymentStatusBox" class="payment-status-box">
                <div class="flex items-center justify-center gap-2">
                    <i class="fas fa-clock text-blue-600"></i>
                    <span class="font-semibold text-blue-800">Aguardando pagamento...</span>
                </div>
                <p class="text-sm mt-1 text-blue-700">Verificando automaticamente a cada 5 segundos</p>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                Voltar para a página inicial
            </a>
        </div>
    </div>

    <div id="notification" class="notification-message"></div>

    <script>
        const transactionHash = "{{ $transactionHash }}";
        let verificarInterval = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Inicia a verificação do pagamento automaticamente
            verificarInterval = setInterval(() => {
                verificarPagamento(transactionHash);
            }, 5000); // Verifica a cada 5 segundos
        });

        function showNotification(message, type = 'success', duration = 3000) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification-message show ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, duration);
        }

        async function copyPixCode() {
            const pixCode = document.getElementById('pixCode').textContent;
            
            try {
                await navigator.clipboard.writeText(pixCode);
                const btn = document.querySelector('.copy-btn');
                const originalText = btn.innerHTML;
                const originalBg = btn.style.backgroundColor;

                btn.innerHTML = '<i class="fas fa-check mr-2"></i>Copiado!';
                btn.style.backgroundColor = '#10b981'; // green-500
                
                showNotification('Código PIX copiado!', 'success');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.backgroundColor = originalBg;
                }, 2000);
            } catch (err) {
                console.error('Erro ao copiar código PIX:', err);
                showNotification('Erro ao copiar código PIX.', 'error');
            }
        }

        async function verificarPagamento(hash) {
            if (!hash) {
                console.error("Hash da transação não fornecido para verificação.");
                return;
            }

            const apiUrl = `/api/goat-payments/check-transaction-status?transaction_hash=${hash}`;

            try {
                const response = await fetch(apiUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();
                const paymentStatusBox = document.getElementById('paymentStatusBox');
                
                if (response.ok && result.status === 'paid') {
                    clearInterval(verificarInterval); // Para de verificar
                    
                    paymentStatusBox.innerHTML = `
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <span class="font-semibold text-green-600">Pagamento confirmado!</span>
                        </div>
                        <p class="text-sm mt-1 text-green-700">Sua compra foi processada com sucesso.</p>
                    `;
                    paymentStatusBox.classList.add('paid'); // Adiciona classe para estilo de pago
                    
                    showNotification('Pagamento confirmado! Redirecionando...', 'success');
                    // Opcional: Redirecionar para uma página de sucesso final após um pequeno delay
                    setTimeout(() => {
                        window.location.href = "{{ route('checkout.success', $transactionHash) }}"; // Redireciona para a página de sucesso
                    }, 3000);

                } else if (response.ok && result.status === 'waiting_payment') {
                    // Mantém o status de aguardando
                    console.log("Status do pagamento:", result.status);
                } else {
                    console.error('Erro ao verificar pagamento:', result.error || 'Erro desconhecido');
                    // Opcional: Mostrar um erro na caixa de status
                    paymentStatusBox.innerHTML = `
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                            <span class="font-semibold text-red-600">Erro na verificação!</span>
                        </div>
                        <p class="text-sm mt-1 text-red-700">Tente recarregar a página ou entre em contato.</p>
                    `;
                    paymentStatusBox.classList.remove('paid');
                }
            } catch (error) {
                console.error('Exceção ao verificar pagamento:', error);
                // Opcional: Mostrar um erro de conexão
                paymentStatusBox.innerHTML = `
                    <div class="flex items-center justify-center gap-2">
                        <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                        <span class="font-semibold text-red-600">Erro de conexão!</span>
                    </div>
                    <p class="text-sm mt-1 text-red-700">Verifique sua internet ou tente novamente mais tarde.</p>
                `;
                paymentStatusBox.classList.remove('paid');
            }
        }
    </script>
</body>
</html>
