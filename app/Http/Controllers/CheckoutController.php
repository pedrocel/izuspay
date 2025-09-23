<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\LedgerEntry;
use App\Http\Requests\StoreCheckoutRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function show(string $hash_id)
    {
        $product = Product::where('hash_id', $hash_id)->with(['association'])->firstOrFail();
        return view('checkout-product', compact('product'));
    }

    public function store(StoreCheckoutRequest $request, string $hash_id): JsonResponse
    {
        $product = Product::where('hash_id', $hash_id)->firstOrFail();
        $validatedData = $request->validated();

        try {
            $paymentData = $this->paymentService->createTransaction($product, $validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Transação iniciada com sucesso!',
                'transaction_hash' => $paymentData['transaction_hash'],
                'pix_qr_code' => $paymentData['pix_qr_code'],
                'total_price' => $product->price * 100,
            ]);
        } catch (\Exception $e) {
            Log::error("Falha ao criar transação: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

   // Em app/Http/Controllers/CheckoutController.php

public function handlePostback(Request $request)
{
    try {
        // Pega o segredo que criamos e salvamos no .env
        $secret = config('services.witetec.webhook_secret');
        
        // Pega a assinatura, que vem DENTRO do corpo do JSON.
        $signatureWithVersion = $request->input('signature');
        
        if (!$secret || !$signatureWithVersion) {
            throw new \Exception('Segredo do webhook ou campo de assinatura não encontrados.');
        }

        // O corpo da requisição que foi usado para gerar a assinatura
        // é o JSON completo, ANTES de ser processado pelo Laravel.
        $payload = $request->getContent();

        // Separa a versão ('v1') do hash
        list($version, $hash) = explode('=', $signatureWithVersion, 2);

        // Gera nossa própria assinatura usando o mesmo método
        $expectedSignature = hash_hmac('sha256', $payload, $secret);

        // Compara as duas assinaturas de forma segura
        // ATENÇÃO: A WiteTec pode estar enviando o hash em um formato diferente (ex: base64).
        // Se a comparação direta falhar, precisaremos ajustar aqui.
        // Mas vamos começar com a comparação direta.
        if (!hash_equals($expectedSignature, $hash)) {
            // Se falhar, vamos logar as duas para comparar
            Log::error('Assinatura do Webhook Inválida.', [
                'assinatura_esperada' => $expectedSignature,
                'assinatura_recebida' => $hash,
            ]);
            throw new \Exception('Assinatura do webhook inválida.');
        }

    } catch (\Exception $e) {
        Log::warning('Falha na autenticação do postback da WiteTec: ' . $e->getMessage());
        return response()->json(['error' => 'Não autorizado'], 401);
    }

    // Se a assinatura for válida, o código continua...
    Log::info('WiteTec Postback Recebido e Autenticado com Sucesso!');
    
    $eventType = $request->input('eventType');
    
    // Processamos apenas se o evento for de pagamento confirmado
    if ($eventType === 'TRANSACTION_PAID') {
        // Precisamos do ID da transação. Vamos supor que ele venha no campo 'transactionId' ou 'id'.
        // Se não soubermos, teremos que inspecionar o corpo completo novamente.
        $transactionId = $request->input('transactionId') ?? $request->input('id');

        if ($transactionId) {
            $this->processPaidSale($transactionId);
        } else {
            Log::warning('Postback autenticado, mas o ID da transação não foi encontrado no corpo.', $request->all());
        }
    }

    return response()->json(['status' => 'success'], 200);
}



    public function checkTransactionStatus(Request $request)
    {
        $request->validate(['transaction_hash' => 'required|string']);
        $transactionHash = $request->transaction_hash;

        $sale = Sale::where('transaction_hash', $transactionHash)->first();

        if (!$sale) {
            return response()->json(['error' => 'Venda não encontrada'], 404);
        }

        if ($sale->status === 'paid') {
            return response()->json([
                'status' => 'paid',
                'redirect_url' => route('checkout.success', $sale->transaction_hash)
            ]);
        }

        try {
            // CORREÇÃO APLICADA AQUI
            $witetecApiKey = config('services.witetec.key');
            $witetecApiUrl = config('services.witetec.url'); // 1. Lemos a URL base da configuração

            // 2. Verificamos se a URL não está vazia para evitar erros
            if (empty($witetecApiUrl)) {
                throw new \Exception('A URL da API da WiteTec não está configurada.');
            }

            // 3. Construímos a URL completa dinamicamente
            $response = Http::withToken($witetecApiKey)
                            ->get("{$witetecApiUrl}/transactions/{$transactionHash}");

            if ($response->successful()) {
                $witetecData = $response->json('data');
                
                if (isset($witetecData['status']) && $witetecData['status'] === 'PAID') {
                    $this->processPaidSale($transactionHash);

                    return response()->json([
                        'status' => 'paid',
                        'redirect_url' => route('checkout.success', $sale->transaction_hash)
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error("Falha ao consultar a API da WiteTec para o hash {$transactionHash}: " . $e->getMessage());
        }

        return response()->json(['status' => $sale->status]);
    }
    /**
     * Lógica centralizada para processar uma venda paga.
     */
    private function processPaidSale(string $transactionHash)
    {
        // Usamos transaction para garantir que todas as operações ocorram com sucesso.
        DB::transaction(function () use ($transactionHash) {
            $sale = Sale::where('transaction_hash', $transactionHash)->lockForUpdate()->first();

            // Idempotência: Se a venda não existe ou já foi processada, não fazemos nada.
            if (!$sale || $sale->status === 'paid') {
                if ($sale) Log::info("Venda #{$sale->id} já estava paga. Nenhuma ação necessária.");
                return;
            }

            // 1. Atualiza o status da venda
            $sale->update(['status' => 'paid']);
            Log::info("Venda #{$sale->id} atualizada para 'paga' via postback/verificação.");

            // 2. Registra as movimentações financeiras
            $this->registerFinancialEntries($sale);
        });
    }

    /**
     * Registra as movimentações financeiras no livro-razão.
     */
    private function registerFinancialEntries(Sale $sale)
    {
        $platformFeePercentage = 9.0;
        $platformFeeDecimal = $platformFeePercentage / 100;
        $platformFeeAmount = $sale->total_price * $platformFeeDecimal;

        // Receita Bruta
        LedgerEntry::create([
            'association_id' => $sale->association_id, 'related_type' => get_class($sale),
            'related_id' => $sale->id, 'type' => 'sale_revenue',
            'description' => "Receita da Venda #{$sale->id}", 'amount' => $sale->total_price,
        ]);

        // Taxa da Plataforma
        LedgerEntry::create([
            'association_id' => $sale->association_id, 'related_type' => get_class($sale),
            'related_id' => $sale->id, 'type' => 'platform_fee',
            'description' => "Taxa da Plataforma ({$platformFeePercentage}%) sobre Venda #{$sale->id}",
            'amount' => -$platformFeeAmount,
        ]);
    }

    public function showSuccess(string $hash)
    {
        $sale = Sale::where('transaction_hash', $hash)->with(['user', 'product.association'])->firstOrFail();
        return view('checkout-success', compact('sale'));
    }
}
