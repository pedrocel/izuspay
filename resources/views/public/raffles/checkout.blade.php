<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - {{ $raffle->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-purple-50 via-pink-50 to-orange-50 min-h-screen">
    
    <div class="container mx-auto px-4 py-8 max-w-2xl" x-data="checkoutApp()">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ route('public.raffles.show', $raffle->hash_id) }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Voltar para a rifa
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Finalizar Compra</h1>
            <p class="text-gray-600 mt-2">{{ $raffle->title }}</p>
        </div>

        <!-- Card Principal -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            
            <!-- Formulário -->
            <div x-show="!showPixCode" class="p-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Seus Dados</h2>
                
                <form @submit.prevent="submitCheckout" class="space-y-6">
                    
                    <!-- Nome -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nome Completo *
                        </label>
                        <input 
                            type="text" 
                            x-model="formData.name"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Seu nome completo"
                        >
                        <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-sm mt-1"></p>
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Telefone/WhatsApp *
                        </label>
                        <input 
                            type="tel" 
                            x-model="formData.phone"
                            required
                            x-mask="(99) 99999-9999"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="(00) 00000-0000"
                        >
                        <p x-show="errors.phone" x-text="errors.phone" class="text-red-500 text-sm mt-1"></p>
                    </div>

                    <!-- Email (opcional) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            E-mail (opcional)
                        </label>
                        <input 
                            type="email" 
                            x-model="formData.email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="seu@email.com"
                        >
                    </div>

                    <!-- Quantidade -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Quantidade de Bilhetes *
                        </label>
                        <div class="flex items-center gap-4">
                            <button 
                                type="button"
                                @click="decreaseQuantity"
                                class="w-12 h-12 bg-gray-200 hover:bg-gray-300 rounded-lg font-bold text-xl"
                            >-</button>
                            <input 
                                type="number" 
                                x-model.number="formData.quantity"
                                min="1"
                                max="{{ $availableTickets }}"
                                required
                                class="w-24 text-center px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-xl font-bold"
                            >
                            <button 
                                type="button"
                                @click="increaseQuantity"
                                class="w-12 h-12 bg-gray-200 hover:bg-gray-300 rounded-lg font-bold text-xl"
                            >+</button>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            Disponíveis: {{ $availableTickets }} bilhetes
                        </p>
                        <p x-show="errors.quantity" x-text="errors.quantity" class="text-red-500 text-sm mt-1"></p>
                    </div>

                    <!-- Total -->
                    <div class="bg-gradient-to-r from-purple-100 to-pink-100 rounded-lg p-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-medium text-gray-700">Total a Pagar:</span>
                            <span class="text-3xl font-bold text-purple-600" x-text="formatCurrency(totalPrice)"></span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">
                            <span x-text="formData.quantity"></span> bilhete(s) × 
                            <span x-text="formatCurrency({{ $raffle->price }})"></span>
                        </p>
                    </div>

                    <!-- Botão Gerar PIX -->
                    <button 
                        type="submit"
                        :disabled="loading"
                        class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 rounded-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span x-show="!loading">🎫 Gerar PIX e Finalizar</span>
                        <span x-show="loading">Gerando PIX...</span>
                    </button>

                </form>
            </div>

            <!-- Tela do PIX -->
            <div x-show="showPixCode" class="p-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">PIX Gerado!</h2>
                    <p class="text-gray-600 mb-6">Escaneie o QR Code ou copie o código PIX</p>

                    <!-- QR Code -->
                    <div class="bg-white p-4 rounded-lg inline-block mb-6">
                        <img :src="'data:image/png;base64,' + pixQrCode" alt="QR Code PIX" class="w-64 h-64 mx-auto">
                    </div>

                    <!-- Código PIX Copia e Cola -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <p class="text-sm text-gray-600 mb-2">Código PIX Copia e Cola:</p>
                        <div class="flex gap-2">
                            <input 
                                type="text" 
                                :value="pixCopyPaste" 
                                readonly
                                class="flex-1 px-3 py-2 bg-white border border-gray-300 rounded text-sm"
                            >
                            <button 
                                @click="copyPixCode"
                                class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded font-medium"
                            >
                                <span x-show="!copied">Copiar</span>
                                <span x-show="copied">✓ Copiado!</span>
                            </button>
                        </div>
                    </div>

                    <!-- Status do Pagamento -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <p class="text-yellow-800 font-medium">
                            ⏳ Aguardando pagamento...
                        </p>
                        <p class="text-sm text-yellow-700 mt-1">
                            Verificando automaticamente a cada 5 segundos
                        </p>
                    </div>

                    <!-- Informações -->
                    <div class="text-left bg-blue-50 rounded-lg p-4">
                        <h3 class="font-semibold text-blue-900 mb-2">📱 Como pagar:</h3>
                        <ol class="text-sm text-blue-800 space-y-1 list-decimal list-inside">
                            <li>Abra o app do seu banco</li>
                            <li>Escolha pagar com PIX</li>
                            <li>Escaneie o QR Code ou cole o código</li>
                            <li>Confirme o pagamento</li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script>
        function checkoutApp() {
            return {
                formData: {
                    name: '',
                    phone: '',
                    email: '',
                    quantity: 1
                },
                errors: {},
                loading: false,
                showPixCode: false,
                pixQrCode: '',
                pixCopyPaste: '',
                transactionHash: '',
                copied: false,
                maxQuantity: {{ $availableTickets }},
                pricePerTicket: {{ $raffle->price }},

                get totalPrice() {
                    return this.formData.quantity * this.pricePerTicket;
                },

                increaseQuantity() {
                    if (this.formData.quantity < this.maxQuantity) {
                        this.formData.quantity++;
                    }
                },

                decreaseQuantity() {
                    if (this.formData.quantity > 1) {
                        this.formData.quantity--;
                    }
                },

                formatCurrency(value) {
                    return 'R$ ' + value.toFixed(2).replace('.', ',');
                },

                async submitCheckout() {
                    this.loading = true;
                    this.errors = {};

                    try {
                        const response = await fetch('{{ route("public.raffles.checkout.store", $raffle->hash_id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.formData)
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.pixQrCode = data.data.pix_qr_code;
                            this.pixCopyPaste = data.data.pix_copy_paste || data.data.pix_qr_code;
                            this.transactionHash = data.data.transaction_hash;
                            this.showPixCode = true;
                            this.startPaymentCheck();
                        } else {
                            this.errors = data.errors || { general: data.message };
                            alert(data.message || 'Erro ao gerar PIX');
                        }
                    } catch (error) {
                        console.error('Erro:', error);
                        alert('Erro ao processar pagamento. Tente novamente.');
                    } finally {
                        this.loading = false;
                    }
                },

                copyPixCode() {
                    navigator.clipboard.writeText(this.pixCopyPaste);
                    this.copied = true;
                    setTimeout(() => this.copied = false, 2000);
                },

                startPaymentCheck() {
                    const interval = setInterval(async () => {
                        try {
                            const response = await fetch('{{ route("public.raffles.checkout.check-status") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ transaction_hash: this.transactionHash })
                            });

                            const data = await response.json();

                            if (data.status === 'paid') {
                                clearInterval(interval);
                                window.location.href = data.redirect_url;
                            }
                        } catch (error) {
                            console.error('Erro ao verificar status:', error);
                        }
                    }, 5000); // Verifica a cada 5 segundos
                }
            }
        }
    </script>

    <!-- Alpine Mask Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
