<div class="max-w-xl mx-auto space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 text-center">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Resumo da sua Compra</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-4">Plano: <strong>{{ $pendingSale->plan->name }}</strong></p>
        <p class="text-4xl font-extrabold text-green-600 dark:text-green-400 mb-6">
            R$ {{ number_format($pendingSale->total_price, 2, ',', '.') }}
        </p>

        <form action="{{ route('cliente.pagamento.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="flex justify-center space-x-4 mb-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" value="credit_card" class="form-radio text-green-600" {{ $pendingSale->payment_method === 'credit_card' ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700 dark:text-gray-300">Cartão de Crédito</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" value="pix" class="form-radio text-green-600" {{ $pendingSale->payment_method === 'pix' ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700 dark:text-gray-300">Pix</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" value="boleto" class="form-radio text-green-600" {{ $pendingSale->payment_method === 'boleto' ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700 dark:text-gray-300">Boleto</span>
                </label>
            </div>

            <div id="payment-details" class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg space-y-4">
                </div>
            
            <button type="submit" class="w-full inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                <span>Finalizar Pagamento</span>
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentDetailsDiv = document.getElementById('payment-details');
        const paymentRadios = document.querySelectorAll('input[name="payment_method"]');

        function updatePaymentDetails(method) {
            let content = '';
            if (method === 'credit_card') {
                content = `<p class="text-sm text-gray-600 dark:text-gray-400">Você será redirecionado para o checkout seguro para inserir os dados do cartão.</p>`;
            } else if (method === 'pix') {
                content = `<p class="text-sm text-gray-600 dark:text-gray-400">Um código Pix e QR code serão gerados após a finalização.</p>`;
            } else if (method === 'boleto') {
                content = `<p class="text-sm text-gray-600 dark:text-gray-400">Um boleto bancário será gerado e enviado para o seu e-mail.</p>`;
            }
            paymentDetailsDiv.innerHTML = content;
        }

        paymentRadios.forEach(radio => {
            radio.addEventListener('change', (e) => updatePaymentDetails(e.target.value));
        });

        // Chamada inicial para preencher o conteúdo com o método padrão
        updatePaymentDetails("{{ $pendingSale->payment_method }}");
    });
</script>