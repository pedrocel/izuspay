<?php

namespace App\Services;

use App\Models\Raffle;
use App\Models\RaffleSale;
use App\Models\RaffleTicket;
use App\Services\Gateways\HazePayService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RafflePaymentService
{
    /**
     * Cria uma venda de rifa e gera o pagamento PIX.
     */
    public function createRaffleSale(Raffle $raffle, int $quantity, array $customerData): array
    {
        return DB::transaction(function () use ($raffle, $quantity, $customerData) {
            
            // Verifica se há tickets disponíveis
            $availableCount = RaffleTicket::where('raffle_id', $raffle->id)
                ->where('status', 'available')
                ->count();

            if ($availableCount < $quantity) {
                throw new \Exception("Apenas {$availableCount} bilhete(s) disponível(is). Você tentou comprar {$quantity}.");
            }

            // Busca as credenciais do gateway (você pode adaptar isso)
            // Por enquanto, vou usar variáveis de ambiente como fallback
            $credentials = [
                'HAZEPAY_SECRET_KEY' => env('HAZEPAY_SECRET_KEY'),
                'HAZEPAY_COMPANY_ID' => env('HAZEPAY_COMPANY_ID'),
            ];

            if (empty($credentials['HAZEPAY_SECRET_KEY']) || empty($credentials['HAZEPAY_COMPANY_ID'])) {
                throw new \Exception('Credenciais do HazePay não configuradas. Configure HAZEPAY_SECRET_KEY e HAZEPAY_COMPANY_ID no .env');
            }

            // Cria a cobrança no gateway
            $gatewayService = new HazePayService();
            $gatewayResponse = $gatewayService->createCharge($raffle, $quantity, $customerData, $credentials);

            // Calcula taxas (exemplo: 5% + R$ 0,40)
            $totalPrice = $raffle->price * $quantity;
            $feePercentage = 5.0;
            $feeFixed = 0.40;
            $feeTotal = ($totalPrice * ($feePercentage / 100)) + $feeFixed;
            $netAmount = $totalPrice - $feeTotal;

            // Cria a venda
            $sale = RaffleSale::create([
                'raffle_id' => $raffle->id,
                'user_id' => null, // Pode vincular a um usuário se tiver
                'buyer_name' => $customerData['name'],
                'buyer_email' => $customerData['email'] ?? null,
                'buyer_phone' => $customerData['phone'],
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'payment_status' => 'pending',
                'payment_method' => 'pix',
                'transaction_hash' => $gatewayResponse['transaction_id'],
                'fee_total' => $feeTotal,
                'net_amount' => $netAmount,
            ]);

            Log::info("Venda de rifa criada: #{$sale->id} - Aguardando pagamento PIX");

            return [
                'sale_id' => $sale->id,
                'transaction_hash' => $gatewayResponse['transaction_id'],
                'pix_qr_code' => $gatewayResponse['pix_qr_code'],
                'pix_copy_paste' => $gatewayResponse['pix_copy_paste'] ?? null,
                'total_price' => $totalPrice,
            ];
        });
    }

    /**
     * Processa o pagamento confirmado (chamado pelo webhook).
     */
    public function processPaidSale(string $transactionHash): void
    {
        DB::transaction(function () use ($transactionHash) {
            $sale = RaffleSale::where('transaction_hash', $transactionHash)
                ->lockForUpdate()
                ->first();

            if (!$sale || $sale->payment_status === 'paid') {
                Log::info("Venda já processada ou não encontrada: {$transactionHash}");
                return;
            }

            // Aloca os tickets
            $tickets = RaffleTicket::where('raffle_id', $sale->raffle_id)
                ->where('status', 'available')
                ->orderBy('number')
                ->limit($sale->quantity)
                ->lockForUpdate()
                ->get();

            if ($tickets->count() < $sale->quantity) {
                Log::error("Tickets insuficientes para a venda #{$sale->id}");
                throw new \Exception('Tickets insuficientes disponíveis');
            }

            foreach ($tickets as $ticket) {
                $ticket->update([
                    'status' => 'sold',
                    'raffle_sale_id' => $sale->id
                ]);
                $sale->tickets()->attach($ticket->id);
            }

            // Atualiza o status da venda
            $sale->update(['payment_status' => 'paid']);

            Log::info("Venda de rifa #{$sale->id} paga com sucesso. Tickets alocados: " . $tickets->pluck('number')->implode(', '));
        });
    }
}
