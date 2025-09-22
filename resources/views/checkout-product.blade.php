<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - {{ $product->name }} - Izus Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="{{ asset('js/qrcode.min.js' ) }}"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .loading-spinner {
            width: 20px; height: 20px; border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%; border-top-color: #fff; animation: spin 1s ease-in-out infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .notification-message {
            position: fixed; top: 20px; left: 50%;
            padding: 12px 24px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000; opacity: 0; transition: opacity 0.3s, transform 0.3s;
            transform: translate(-50%, -20px);
        }
        .notification-message.show { opacity: 1; transform: translate(-50%, 0); }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        
        <div class="grid lg:grid-cols-5 gap-8">

            <!-- COLUNA ESQUERDA: Formulário -->
            <div class="lg:col-span-3 space-y-6">
                
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl font-bold text-gray-900">Finalize sua Compra</h1>
                    <p class="text-gray-600 mt-1">Falta pouco! Preencha seus dados para garantir o acesso.</p>
                </div>

                <div id="general-errors" class="hidden bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl" role="alert">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-exclamation-circle mt-1"></i>
                        <div>
                            <strong class="font-bold">Ops! Verifique os seguintes erros:</strong>
                            <ul class="mt-2 list-disc list-inside text-sm" id="error-list"></ul>
                        </div>
                    </div>
                </div>

                <form id="checkout-form" class="space-y-6">
                    @csrf
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200">
                        <div class="p-6 border-b border-gray-200 flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 border border-blue-200 rounded-full flex items-center justify-center text-blue-600 font-semibold">1</div>
                            <h2 class="text-xl font-semibold text-gray-900">Seus Dados</h2>
                        </div>
                        <div class="p-6 grid md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Digite seu nome completo"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <p class="text-red-600 text-xs mt-1 hidden" data-error="name"></p>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="seu@email.com"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <p class="text-red-600 text-xs mt-1 hidden" data-error="email"></p>
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="(11) 99999-9999"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <p class="text-red-600 text-xs mt-1 hidden" data-error="phone"></p>
                            </div>
                            <div>
                                <label for="document" class="block text-sm font-medium text-gray-700 mb-1">CPF/CNPJ</label>
                                <input type="text" name="document" id="document" value="{{ old('document') }}" required placeholder="000.000.000-00"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <p class="text-red-600 text-xs mt-1 hidden" data-error="document"></p>
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Crie uma Senha</label>
                                <input type="password" name="password" id="password" required placeholder="••••••••"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <p class="text-red-600 text-xs mt-1 hidden" data-error="password"></p>
                            </div>
                            <div class="md:col-span-2">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirme sua Senha</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200">
                        <div class="p-6 border-b border-gray-200 flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 border border-blue-200 rounded-full flex items-center justify-center text-blue-600 font-semibold">2</div>
                            <h2 class="text-xl font-semibold text-gray-900">Pagamento</h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <label class="flex items-center p-4 border-2 border-blue-500 rounded-xl cursor-pointer bg-blue-50 transition-colors">
                                <input type="radio" name="payment_method" value="pix" class="h-5 w-5 text-blue-600 focus:ring-blue-500" checked>
                                <div class="ml-4 flex-1"><span class="font-medium text-gray-900">PIX</span><p class="text-sm text-gray-600">Pagamento instantâneo.</p></div>
                                <span class="text-xs font-bold text-blue-600">100% Aprovado</span>
                            </label>
                            <div class="flex items-center p-4 border border-gray-300 rounded-xl opacity-60 cursor-not-allowed">
                                <input type="radio" name="payment_method" value="credit_card" class="h-5 w-5" disabled>
                                <div class="ml-4 flex-1"><span class="font-medium text-gray-500">Cartão de Crédito</span><p class="text-sm text-gray-500">Parcele sua compra.</p></div>
                                <span class="text-xs font-medium text-yellow-600">Em breve</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- COLUNA DIREITA: Resumo do Pedido -->
            <div class="lg:col-span-2">
                <div class="sticky top-8 space-y-6">
                    <div id="order-summary" class="bg-white rounded-2xl shadow-lg border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Resumo do Pedido</h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}" class="w-20 h-20 rounded-lg object-cover border-2 border-gray-200">
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $product->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $product->association->nome ?? 'Vendedor Padrão' }}</p>
                                </div>
                            </div>
                            <div class="border-t border-gray-200 pt-4 flex justify-between items-center text-lg">
                                <span class="font-medium text-gray-700">Total</span>
                                <span class="font-bold text-2xl text-blue-600">R$ {{ number_format($product->price, 2, ',', '.' ) }}</span>
                            </div>
                        </div>
                        <div class="p-6 border-t border-gray-200">
                            <button type="submit" form="checkout-form" id="submit-button" class="w-full bg-gradient-to-r from-blue-500 to-cyan-600 hover:from-blue-600 hover:to-cyan-700 text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg hover:shadow-blue-500/30 flex items-center justify-center">
                                <span id="button-text" class="flex items-center"><i class="fas fa-lock mr-2"></i> Finalizar Compra</span>
                                <span id="loading-spinner" class="loading-spinner hidden"></span>
                            </button>
                            <p class="text-xs text-gray-500 text-center mt-3 flex items-center justify-center"><i class="fas fa-shield-alt mr-1.5"></i>Ambiente 100% seguro.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção de Pagamento PIX (oculta) -->
            <div id="pix-payment-section" class="hidden lg:col-span-5">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center max-w-lg mx-auto">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Pagamento via PIX</h2>
                    <p class="text-gray-600">Escaneie o QR Code ou use o código "copia e cola".</p>
                    <p class="text-4xl font-extrabold text-blue-600 mt-4">
                        R$ <span id="pix-total-price">{{ number_format($product->price, 2, ',', '.') }}</span>
                    </p>
                    <div class="mt-6 flex flex-col items-center">
                        <div id="pix-qr-code-container" class="p-3 bg-white rounded-lg shadow-md border border-gray-200"></div>
                        <div class="w-full mt-6">
                            <p class="text-sm text-gray-600 mb-2">Código PIX (copia e cola):</p>
                            <div class="relative">
                                <input id="pix-code" readonly class="w-full bg-gray-100 border border-gray-300 rounded-lg p-3 pr-12 text-xs text-gray-700 font-mono text-center" />
                                <button onclick="copyPixCode()" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-500 hover:text-blue-600 rounded-md hover:bg-gray-200 transition-colors" title="Copiar Código">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="paymentStatusBox" class="mt-6 p-4 rounded-lg border flex items-center justify-center gap-3 bg-blue-50 border-blue-300 text-blue-800">
                        <i class="fas fa-clock"></i>
                        <span class="font-semibold">Aguardando pagamento...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="notification" class="notification-message"></div>

    <script>
        const fontAwesomeLink = document.createElement('link');
        fontAwesomeLink.rel = 'stylesheet';
        fontAwesomeLink.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css';
        document.head.appendChild(fontAwesomeLink );

        const checkoutForm = document.getElementById('checkout-form');
        const submitButton = document.getElementById('submit-button');
        const buttonText = document.getElementById('button-text');
        const loadingSpinner = document.getElementById('loading-spinner');
        const formColumns = document.querySelector('.lg\\:col-span-3');
        const summaryColumn = document.querySelector('.lg\\:col-span-2');
        const pixPaymentSection = document.getElementById('pix-payment-section');
        let verificarInterval;

        function clearFieldErrors() {
            document.querySelectorAll('[data-error]').forEach(el => el.classList.add('hidden'));
            document.getElementById('general-errors').classList.add('hidden');
        }

        function displayFieldErrors(errors) {
            const errorList = document.getElementById('error-list');
            errorList.innerHTML = '';
            for (const [field, messages] of Object.entries(errors)) {
                const errorElement = document.querySelector(`[data-error="${field}"]`);
                if (errorElement) {
                    errorElement.textContent = messages[0];
                    errorElement.classList.remove('hidden');
                } else {
                    const li = document.createElement('li');
                    li.textContent = messages[0];
                    errorList.appendChild(li);
                }
            }
            document.getElementById('general-errors').classList.remove('hidden');
        }

        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification-message font-medium ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}`;
            notification.classList.add('show');
            setTimeout(() => notification.classList.remove('show'), 5000);
        }

        function copyPixCode() {
            const pixCode = document.getElementById('pix-code').value;
            navigator.clipboard.writeText(pixCode).then(() => showNotification('Código PIX copiado!', 'success'));
        }

        function verificarPagamento(transactionHash) {
            fetch(`/api/goat-payments/check-transaction-status?transaction_hash=${transactionHash}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'paid') {
                        clearInterval(verificarInterval);
                        const statusBox = document.getElementById('paymentStatusBox');
                        statusBox.innerHTML = `<i class="fas fa-check-circle"></i><span class="font-semibold">Pagamento confirmado! Redirecionando...</span>`;
                        statusBox.className = 'mt-6 p-4 rounded-lg border flex items-center justify-center gap-3 bg-green-100 border-green-300 text-green-800';
                        setTimeout(() => window.location.href = data.redirect_url, 2000);
                    }
                }).catch(error => console.error('Erro ao verificar pagamento:', error));
        }

        checkoutForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            clearFieldErrors();
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');

            const formData = new FormData(checkoutForm);
            const data = Object.fromEntries(formData.entries());
            data.hash_id = "{{ $product->hash_id }}";

            try {
                const response = await fetch("{{ route('checkout.product.store', $product->hash_id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json', 'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();

                if (response.ok) {
                    document.getElementById('pix-total-price').textContent = (result.total_price / 100).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                    document.getElementById('pix-code').value = result.pix_qr_code;
                    const qrContainer = document.getElementById('pix-qr-code-container');
                    qrContainer.innerHTML = '';
                    new QRCode(qrContainer, { text: result.pix_qr_code, width: 192, height: 192, colorDark: "#111827", colorLight: "#ffffff", correctLevel: QRCode.CorrectLevel.H });
                    
                    formColumns.classList.add('hidden');
                    summaryColumn.classList.add('hidden');
                    pixPaymentSection.classList.remove('hidden');

                    verificarInterval = setInterval(() => verificarPagamento(result.transaction_hash), 5000);
                } else {
                    displayFieldErrors(result.errors || { general: [result.message || 'Erro desconhecido.'] });
                    showNotification(result.message || 'Por favor, corrija os erros.', 'error');
                }
            } catch (error) {
                showNotification('Erro de conexão. Tente novamente.', 'error');
            } finally {
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
