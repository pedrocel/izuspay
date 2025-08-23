<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - {{ $product->name }} - Adoring Fans</title>
    {{-- Adicionado CSRF Token para requisições AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        pink: {
                            50: '#fdf2f8', 100: '#fce7f3', 200: '#fbcfe8', 300: '#f9a8d4', 400: '#f472b6',
                            500: '#ec4899', 600: '#db2777', 700: '#be185d', 800: '#9d174d', 900: '#831843'
                        },
                        gray: {
                            50: '#f9fafb', 100: '#f3f4f6', 200: '#e5e7eb', 300: '#d1d5db', 400: '#9ca3af',
                            500: '#6b7280', 600: '#4b5563', 700: '#374151', 800: '#1f2937', 900: '#111827', 950: '#030712'
                        },
                        red: {
                            50: '#fef2f2', 100: '#fee2e2', 200: '#fecaca', 300: '#fca5a5', 400: '#f87171',
                            500: '#ef4444', 600: '#dc2626', 700: '#b91c1c', 800: '#991b1b', 900: '#7f1d1d'
                        },
                        green: {
                            50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac', 400: '#4ade80',
                            500: '#22c55e', 600: '#16a34a', 700: '#15803d', 800: '#14532d', 900: '#052e16'
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            background: #059669;
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
            background: #047857;
        }
        .payment-status-box {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            color: #0c4a6e;
            border-radius: 8px;
            padding: 16px;
            margin-top: 24px;
            text-align: center;
        }
        .payment-status-box.paid {
            background: #ecfdf5;
            border-color: #10b981;
            color: #065f46;
        }
        .notification-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #10b981;
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
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen text-gray-900 dark:text-gray-100 transition-colors duration-200">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        {{-- Mudado de $plan para $product --}}
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-lg mb-4 shadow-md">
        @else
            <div class="w-full h-32 bg-gradient-to-br from-pink-500 to-pink-700 rounded-lg mb-4 flex items-center justify-center shadow-md">
                <i class="fas fa-box text-white text-3xl"></i>
            </div>
        @endif
        <div class="text-center mb-8">
            <p class="text-gray-600 dark:text-gray-400">Falta pouco, agora precisamos dos seus dados:</p>
        </div>

        {{-- Container para mensagens de erro gerais --}}
        <div id="general-errors" class="hidden bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl relative mb-6" role="alert">
            <strong class="font-bold">Ops!</strong>
            <span class="block sm:inline">Houve alguns problemas com seus dados.</span>
            <ul class="mt-2 list-disc list-inside" id="error-list"></ul>
        </div>

        <form id="checkout-form" class="grid lg:grid-cols-3 gap-8">
            @csrf
            
            <!-- Formulário Principal -->
            <div id="form-section" class="lg:col-span-2 space-y-6">
                
                <!-- Dados Pessoais -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3 shadow-md">1</div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Dados Pessoais</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome Completo</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                   placeholder="Digite seu nome completo">
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" data-error="name"></p>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">E-mail</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                   placeholder="seu@email.com">
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" data-error="email"></p>
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Telefone</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                   placeholder="(11) 99999-9999">
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" data-error="phone"></p>
                        </div>
                        
                        <div>
                            <label for="document" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">CPF/CNPJ</label>
                            <input type="text" name="document" id="document" value="{{ old('document') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                   placeholder="000.000.000-00">
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" data-error="document"></p>
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Senha</label>
                            <input type="password" name="password" id="password" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                   placeholder="Crie uma senha">
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" data-error="password"></p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                   placeholder="Confirme sua senha">
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" data-error="password_confirmation"></p>
                        </div>
                    </div>
                </div>

                <!-- Método de Pagamento -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3 shadow-md">2</div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Método de Pagamento</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- PIX -->
                        <label class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors shadow-sm">
                            <input type="radio" name="payment_method" value="pix" class="text-pink-500 focus:ring-pink-500 h-5 w-5" checked>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center">
                                    <i class="fas fa-qrcode text-pink-500 mr-2"></i>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">PIX</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Pagamento instantâneo via QR Code</p>
                            </div>
                            <div class="bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200 px-2 py-1 rounded text-xs font-medium shadow-sm">
                                Instantâneo
                            </div>
                        </label>

                        <!-- Cartão de Crédito em breve -->
                        <div class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg opacity-60 cursor-not-allowed shadow-sm">
                            <input type="radio" name="payment_method" value="credit_card" class="text-gray-400 h-5 w-5" disabled>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center">
                                    <i class="fas fa-credit-card text-gray-400 mr-2"></i>
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Cartão de Crédito</span>
                                </div>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Parcelamento em até 12x sem juros</p>
                            </div>
                            <div class="bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 px-2 py-1 rounded text-xs font-medium shadow-sm">
                                Em breve
                            </div>
                        </div>

                        <!-- Criptomoedas em breve -->
                        <div class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg opacity-60 cursor-not-allowed shadow-sm">
                            <input type="radio" name="payment_method" value="crypto" class="text-gray-400 h-5 w-5" disabled>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center">
                                    <i class="fab fa-bitcoin text-gray-400 mr-2"></i>
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Criptomoedas</span>
                                </div>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Bitcoin, Ethereum e outras</p>
                            </div>
                            <div class="bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 px-2 py-1 rounded text-xs font-medium shadow-sm">
                                Em breve
                            </div>
                        </div>

                        <p class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" data-error="payment_method"></p>
                    </div>
                </div>
            </div>

            <!-- Resumo do Pedido -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 sticky top-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Resumo do Pedido</h3>
                    
                    <!-- Produto Selecionado -->
                    {{-- Mudado de plano para produto --}}
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 mb-6 shadow-sm">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-lg mb-4 shadow-md">
                        @else
                            <div class="w-full h-32 bg-gradient-to-br from-pink-500 to-pink-700 rounded-lg mb-4 flex items-center justify-center shadow-md">
                                <i class="fas fa-box text-white text-3xl"></i>
                            </div>
                        @endif
                        
                        <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ $product->name }}</h4>
                        @if($product->description)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ Str::limit($product->description, 100) }}</p>
                        @endif
                    </div>
                    
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <div class="flex items-center justify-between text-lg font-semibold text-gray-900 dark:text-gray-100">
                            <span>Total:</span>
                            {{-- Mudado para usar price do produto com formatação correta --}}
                            <span class="text-pink-600">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <!-- Botão de Finalizar -->
                    <button type="submit" id="submit-button"
                            class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-4 px-6 rounded-lg transition-colors mt-6 flex items-center justify-center shadow-lg hover:shadow-xl">
                        <span id="button-text"><i class="fas fa-lock mr-2"></i> Finalizar Compra</span>
                        <span id="loading-spinner" class="loading-spinner hidden"></span>
                    </button>
                    
                    <!-- Segurança -->
                    <div class="mt-4 text-center">
                        <div class="flex items-center justify-center text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-shield-alt mr-2"></i>
                            Pagamento 100% seguro
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Seção de Pagamento PIX (inicialmente oculta) --}}
        <div id="pix-payment-section" class="hidden lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-8 text-center">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Pagamento via PIX</h1>
                {{-- Mudado para produto --}}
                <p class="text-gray-600 dark:text-gray-400">Finalize sua compra do produto **<span id="pix-product-name"></span>**</p>
                <p class="text-3xl font-extrabold text-pink-600 mt-4">
                    R$ <span id="pix-total-price">{{ number_format($product->price, 2, ',', '.') }}</span>
                </p>

                <div class="text-center mt-6">
                    <p class="text-gray-700 dark:text-gray-300 mb-4">Escaneie o QR Code com o app do seu banco:</p>
                    <div class="w-48 h-48 mx-auto border border-gray-300 dark:border-gray-600 rounded-lg flex items-center justify-center overflow-hidden shadow-md">
                        <img id="pix-qr-code-image" src="/placeholder.svg" alt="QR Code PIX" class="w-full h-full object-contain">
                    </div>

                    <p class="text-gray-700 dark:text-gray-300 mt-6 mb-2">Ou copie e cole o código PIX:</p>
                    <div class="pix-code-container bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <span id="pix-code"></span>
                    </div>
                    <button onclick="copyPixCode()" class="copy-btn bg-pink-600 hover:bg-pink-700">
                        <i class="fas fa-copy mr-2"></i>
                        Copiar Código PIX
                    </button>

                    <div id="paymentStatusBox" class="payment-status-box bg-blue-100 dark:bg-blue-900/20 border-blue-400 dark:border-blue-700 text-blue-800 dark:text-blue-300">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-clock text-blue-600 dark:text-blue-400"></i>
                            <span class="font-semibold">Aguardando pagamento...</span>
                        </div>
                        <p class="text-sm mt-1">Verificando automaticamente a cada 5 segundos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="notification" class="notification-message"></div>

    <script>
        const checkoutForm = document.getElementById('checkout-form');
        const submitButton = document.getElementById('submit-button');
        const buttonText = document.getElementById('button-text');
        const loadingSpinner = document.getElementById('loading-spinner');
        const formSection = document.getElementById('form-section');
        const pixPaymentSection = document.getElementById('pix-payment-section');
        let verificarInterval;
        let currentTransactionHash;

        function clearFieldErrors() {
            document.querySelectorAll('[data-error]').forEach(element => {
                element.classList.add('hidden');
                element.textContent = '';
            });
            document.getElementById('general-errors').classList.add('hidden');
        }

        function displayFieldErrors(errors) {
            for (const [field, messages] of Object.entries(errors)) {
                const errorElement = document.querySelector(`[data-error="${field}"]`);
                if (errorElement) {
                    errorElement.textContent = messages[0];
                    errorElement.classList.remove('hidden');
                }
            }
        }

        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification-message ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 5000);
        }

        function copyPixCode() {
            const pixCode = document.getElementById('pix-code').textContent;
            navigator.clipboard.writeText(pixCode).then(() => {
                showNotification('Código PIX copiado!', 'success');
            });
        }

        function verificarPagamento(transactionHash) {

            const apiUrl = `/api/goat-payments/check-transaction-status?transaction_hash=${transactionHash}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'paid') {
                        clearInterval(verificarInterval);
                        document.getElementById('paymentStatusBox').innerHTML = `
                            <div class="flex items-center justify-center gap-2">
                                <i class="fas fa-check-circle text-green-600"></i>
                                <span class="font-semibold">Pagamento confirmado!</span>
                            </div>
                            <p class="text-sm mt-1">Redirecionando...</p>
                        `;
                        document.getElementById('paymentStatusBox').className = 'payment-status-box paid bg-green-100 dark:bg-green-900/20 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300';
                        
                        setTimeout(() => {
                            window.location.href = data.redirect_url;
                        }, 2000);
                    }
                })
                .catch(error => console.error('Erro ao verificar pagamento:', error));
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
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    showNotification(result.message || 'Compra finalizada com sucesso!', 'success');
                    
                    document.getElementById('pix-product-name').textContent = result.product_name;
                    document.getElementById('pix-total-price').textContent = (result.total_price / 100).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    document.getElementById('pix-qr-code-image').src = result.pix_qr_code_image;
                    document.getElementById('pix-code').textContent = result.pix_qr_code;
                    currentTransactionHash = result.transaction_hash;

                    formSection.classList.add('hidden');
                    pixPaymentSection.classList.remove('hidden');

                    verificarInterval = setInterval(() => {
                        verificarPagamento(currentTransactionHash);
                    }, 5000);

                } else if (response.status === 422) {
                    displayFieldErrors(result.errors);
                    showNotification(result.message || 'Por favor, corrija os erros no formulário.', 'error');
                } else {
                    showNotification(result.message || 'Ocorreu um erro inesperado. Tente novamente.', 'error');
                    console.error('Erro na resposta do servidor:', result);
                }
            } catch (error) {
                showNotification('Erro de conexão. Verifique sua internet e tente novamente.', 'error');
                console.error('Erro na requisição AJAX:', error);
            } finally {
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
