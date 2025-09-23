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

    public function handlePostback(Request $request)
    {
        // AVISO: Esta versão não verifica a assinatura do webhook.
        // É funcional, mas INSEGURA. Use com cautela.

        Log::info('WiteTec Postback Recebido (SEM VERIFICAÇÃO DE ASSINATURA):', $request->all());
        
        $data = $request->input('data');
        
        // Verificação mínima para garantir que os dados esperados existem
        if (!$data || !isset($data['id']) || !isset($data['status'])) {
            Log::warning('Postback recebido, mas com formato de dados inesperado.', $request->all());
            return response()->json(['error' => 'Parâmetros ausentes'], 400);
        }

        // Processa o pagamento se o status for 'PAID'
        if ($data['status'] === 'PAID') {
            $this->processPaidSale($data['id']);
        }

        // Responde que recebeu com sucesso
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
