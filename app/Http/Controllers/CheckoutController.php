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

    /**
     * Endpoint para receber postbacks da WiteTec.
     */
    public function handlePostback(Request $request)
    {
        Log::info('WiteTec Postback Recebido:', $request->all());
        
        // A WiteTec envia o ID da transação no corpo do postback
        $transactionHash = $request->input('id'); 
        $status = $request->input('status');

        if (!$transactionHash || !$status) {
            Log::warning('Postback inválido da WiteTec: parâmetros ausentes.');
            return response()->json(['error' => 'Parâmetros ausentes'], 400);
        }

        if ($status === 'PAID') { // WiteTec usa 'PAID' em maiúsculas
            $this->processPaidSale($transactionHash);
        }

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Endpoint para o frontend verificar o status do pagamento.
     */
    public function checkTransactionStatus(Request $request)
    {
        $request->validate(['transaction_hash' => 'required|string']);
        $transactionHash = $request->transaction_hash;

        $sale = Sale::where('transaction_hash', $transactionHash)->first();

        if (!$sale) {
            return response()->json(['error' => 'Venda não encontrada'], 404);
        }

        // Para simplificar, vamos apenas retornar o status do nosso banco.
        // O status do nosso banco é a "fonte da verdade", atualizada pelo postback.
        if ($sale->status === 'paid') {
            return response()->json([
                'status' => 'paid',
                'redirect_url' => route('checkout.success', $sale->transaction_hash)
            ]);
        }

        return response()->json(['status' => $sale->status]);
    }

    /**
     * Lógica centralizada para processar uma venda paga.
     */
    private function processPaidSale(string $transactionHash)
    {
        DB::transaction(function () use ($transactionHash) {
            $sale = Sale::where('transaction_hash', $transactionHash)->lockForUpdate()->first();

            // Se a venda não existe ou já foi paga, não faz nada.
            if (!$sale || $sale->status === 'paid') {
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
