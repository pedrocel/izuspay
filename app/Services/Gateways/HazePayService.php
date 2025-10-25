<?php

namespace App\Services\Gateways;

use App\Models\Raffle;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HazePayService implements RaffleGatewayInterface
{
    public function createCharge(Raffle $raffle, int $quantity, array $customerData, array $credentials): array
    {
        $secretKey = $credentials['HAZEPAY_SECRET_KEY'] ?? null;
        $companyId = $credentials['HAZEPAY_COMPANY_ID'] ?? null;

        if (!$secretKey || !$companyId) {
            throw new \Exception('Secret Key ou Company ID da HazePay não encontrados nas credenciais do gateway.');
        }

        $totalAmount = $raffle->price * $quantity;
        
        // Remove caracteres não numéricos do telefone
        $phone = preg_replace('/\D/', '', $customerData['phone']);
        
        $payload = [
            'customer' => [
                'name' => $customerData['name'],
                'email' => $customerData['email'] ?? 'cliente@email.com',
                'phone' => $phone,
                'document' => [
                    'type' => 'CPF',
                    'number' => '00000000000' // CPF não é obrigatório para PIX
                ]
            ],
            'items' => [
                [
                    'title' => $raffle->title . " - {$quantity} bilhete(s)",
                    'unitPrice' => (int) ($raffle->price * 100), // em centavos
                    'quantity' => $quantity,
                    'externalRef' => (string) $raffle->id,
                ]
            ],
            'amount' => (int) ($totalAmount * 100), // em centavos
            'paymentMethod' => 'PIX',
            'postbackUrl' => route('api.hazepay.webhook'),
            'metadata' => [
                'raffle_id' => $raffle->id,
                'quantity' => $quantity,
            ],
            'description' => "Compra de {$quantity} bilhete(s) - {$raffle->title}",
        ];

        // Autenticação Basic: base64(secretKey:companyId)
        $credentials = base64_encode("{$secretKey}:{$companyId}");

        $response = Http::withHeaders([
            'Authorization' => "Basic {$credentials}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://api.hazepayments.com/functions/v1/transactions', $payload);

        if ($response->failed()) {
            $errorData = $response->json() ?? ['message' => $response->body()];
            Log::error('HazePay API Error:', [
                'payload' => $payload,
                'status' => $response->status(),
                'response' => $errorData,
            ]);
            throw new \Exception($errorData['message'] ?? 'Falha na comunicação com o gateway de pagamento HazePay.');
        }

        $responseData = $response->json();

        // HazePay retorna o QR code no campo 'pix.qrCode' ou similar
        return [
            'transaction_id' => $responseData['id'] ?? $responseData['data']['id'],
            'pix_qr_code' => $responseData['pix']['qrCode'] ?? $responseData['data']['pix']['qrCode'],
            'pix_copy_paste' => $responseData['pix']['copyPaste'] ?? $responseData['data']['pix']['copyPaste'] ?? null,
        ];
    }

    public function getTransactionStatus(string $transactionId, array $credentials): string
    {
        $secretKey = $credentials['HAZEPAY_SECRET_KEY'] ?? null;
        $companyId = $credentials['HAZEPAY_COMPANY_ID'] ?? null;

        if (!$secretKey || !$companyId) {
            return 'PENDING';
        }

        $auth = base64_encode("{$secretKey}:{$companyId}");

        $response = Http::withHeaders([
            'Authorization' => "Basic {$auth}",
            'Accept' => 'application/json',
        ])->get("https://api.hazepayments.com/functions/v1/transactions/{$transactionId}");

        if ($response->successful()) {
            $data = $response->json();
            return $data['status'] ?? 'PENDING';
        }

        return 'PENDING';
    }
}
