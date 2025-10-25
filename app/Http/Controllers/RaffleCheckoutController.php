<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\RaffleSale;
use App\Services\RafflePaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RaffleCheckoutController extends Controller
{
    protected $paymentService;

    public function __construct(RafflePaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Exibe a página de checkout.
     */
    public function show(string $hash_id)
    {
        $raffle = Raffle::where('hash_id', $hash_id)
            ->where('status', 'active')
            ->firstOrFail();

        $availableTickets = $raffle->availableTicketsCount();

        if ($availableTickets === 0) {
            return redirect()->route('raffles.show', $hash_id)
                ->with('error', 'Todos os bilhetes já foram vendidos!');
        }

        return view('public.raffles.checkout', compact('raffle', 'availableTickets'));
    }

    /**
     * Processa a compra e gera o PIX.
     */
    public function store(Request $request, string $hash_id)
    {
        $raffle = Raffle::where('hash_id', $hash_id)
            ->where('status', 'active')
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'phone' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:100',
            'quantity' => 'required|integer|min:1|max:20',
        ], [
            'name.required' => 'O nome é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'quantity.required' => 'A quantidade é obrigatória',
            'quantity.min' => 'Quantidade mínima é 1',
            'quantity.max' => 'Quantidade máxima é 20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $paymentData = $this->paymentService->createRaffleSale(
                $raffle,
                $request->quantity,
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Pagamento gerado com sucesso!',
                'data' => $paymentData
            ]);

        } catch (\Exception $e) {
            Log::error("Erro ao criar venda de rifa: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Webhook do HazePay.
     */
    public function handleWebhook(Request $request)
    {
        Log::info('Webhook HazePay recebido:', $request->all());

        $transactionId = $request->input('id');
        $status = $request->input('status');

        if (!$transactionId) {
            Log::warning('Webhook sem transaction ID');
            return response()->json(['status' => 'error - no transaction id'], 400);
        }

        // Processa apenas pagamentos confirmados
        if ($status === 'PAID' || $status === 'paid') {
            try {
                $this->paymentService->processPaidSale($transactionId);
                Log::info("Pagamento processado via webhook: {$transactionId}");
            } catch (\Exception $e) {
                Log::error("Erro ao processar webhook: " . $e->getMessage());
                return response()->json(['status' => 'error'], 500);
            }
        }

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Verifica o status do pagamento (polling).
     */
    public function checkStatus(Request $request)
    {
        $request->validate(['transaction_hash' => 'required|string']);

        $sale = RaffleSale::where('transaction_hash', $request->transaction_hash)
            ->with('tickets')
            ->first();

        if (!$sale) {
            return response()->json(['error' => 'Venda não encontrada'], 404);
        }

        if ($sale->payment_status === 'paid') {
            return response()->json([
                'status' => 'paid',
                'ticket_numbers' => $sale->tickets->pluck('number')->toArray(),
                'redirect_url' => route('raffles.success', $sale->id)
            ]);
        }

        return response()->json(['status' => $sale->payment_status]);
    }

    /**
     * Página de sucesso após pagamento.
     */
    public function success($saleId)
    {
        $sale = RaffleSale::with(['raffle', 'tickets'])
            ->findOrFail($saleId);

        if ($sale->payment_status !== 'paid') {
            return redirect()->route('raffles.index')
                ->with('error', 'Pagamento ainda não confirmado');
        }

        return view('public.raffles.success', compact('sale'));
    }
}
