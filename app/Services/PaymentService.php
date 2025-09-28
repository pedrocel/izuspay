<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use App\Services\Gateways\WiteTecService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
// Crypt não é mais necessário aqui, a menos que use em outro lugar
// use Illuminate\Support\Facades\Crypt; 

class PaymentService
{
    /**
     * Orquestra a criação da venda e da transação de pagamento.
     */
    public function createTransaction(Product $product, array $customerData): array
    {
        return DB::transaction(function () use ($product, $customerData) {
            
            $association = $product->association()->with('wallet.gateway')->first();
            $wallet = $association->wallet;

            if (!$wallet || !$wallet->gateway) {
                throw new \Exception("Nenhum gateway de pagamento configurado para o vendedor.");
            }

            $gateway = $wallet->gateway;

            $gatewayService = $this->getGatewayService($gateway->slug);

            $credentials = [];
            if (isset($gateway->credentials_schema['fields']) && is_array($gateway->credentials_schema['fields'])) {
                foreach ($gateway->credentials_schema['fields'] as $field) {
                    $credentials[$field['name']] = $field['label'];
                }
            }

            if (empty($credentials)) {
                throw new \Exception("As credenciais para o gateway '{$gateway->name}' não estão configuradas corretamente no schema.");
            }

            $gatewayResponse = $gatewayService->createCharge($product, $customerData, $credentials);

            $user = User::firstOrCreate(
                ['email' => $customerData['email']],
                [
                    'name' => $customerData['name'],
                    'phone' => preg_replace('/\D/', '', $customerData['phone']),
                    'documento' => preg_replace('/\D/', '', $customerData['document']),
                    'password' => Hash::make(Str::random(16)),
                    'association_id' => $product->association_id,
                    'tipo' => 'cliente',
                    'status' => 'active',
                ]
            );

            $feeConfig = $association->fees()->where('payment_method', 'pix')->first();
            $percentageFee = $feeConfig->percentage_fee ?? 4.99;
            $fixedFee = $feeConfig->fixed_fee ?? 0.40;

            $totalFee = ($product->price * ($percentageFee / 100)) + $fixedFee;
            $netAmount = $product->price - $totalFee;

            $sale = Sale::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'association_id' => $product->association_id,
                'status' => 'awaiting_payment',
                'total_price' => $product->price,
                'payment_method' => 'pix',
                'transaction_hash' => $gatewayResponse['transaction_id'],
                'fee_percentage' => $percentageFee,
                'fee_fixed' => $fixedFee,
                'fee_total' => $totalFee,
                'net_amount' => $netAmount,
            ]);

            if ($wallet) {
                // 'increment' é uma forma segura e atômica de adicionar valor a uma coluna.
                // Ele previne condições de corrida (race conditions).
                $wallet->increment('balance', $sale->net_amount);
                Log::info("Creditado R$ {$sale->net_amount} na carteira #{$wallet->id} referente à venda #{$sale->id}.");
            } else {
                // Log de erro crítico se, por algum motivo, o vendedor não tiver uma carteira.
                Log::critical("Venda #{$sale->id} paga, mas a association #{$sale->association_id} não possui uma carteira para creditar o saldo.");
            }

            return [
                'transaction_hash' => $gatewayResponse['transaction_id'],
                'pix_qr_code' => $gatewayResponse['pix_qr_code'],
            ];
        });
    }

    /**
     * Factory para obter a instância do serviço de gateway.
     */
    protected function getGatewayService(string $gatewaySlug)
    {
        switch ($gatewaySlug) {
            case 'witetec': // Este slug deve corresponder ao que você cadastrou no banco
                return new WiteTecService();
            case 'mercado-pago':
                // return new MercadoPagoService(); // Exemplo para o futuro
            default:
                throw new \Exception("Gateway '{$gatewaySlug}' não suportado.");
        }
    }
}
