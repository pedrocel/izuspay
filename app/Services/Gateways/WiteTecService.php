<?php

namespace App\Services\Gateways;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WiteTecService implements GatewayInterface
{
    public function createCharge(Product $product, array $customerData, array $credentials ): array
    {
        // As credenciais agora vêm do schema
        $apiUrl = $credentials['WITETEC_API_URL'] ?? null;
        $apiKey = $credentials['WITETEC_API_KEY'] ?? null;

        if (!$apiUrl || !$apiKey) {
            throw new \Exception('URL ou Chave de API da WiteTec não encontradas nas credenciais do gateway.');
        }

        // ... (resto do código do payload é o mesmo)
        $document = preg_replace('/\D/', '', $customerData['document']);
        $documentType = strlen($document) === 11 ? 'CPF' : 'CNPJ';

        $payload = [
            'amount' => (int) ($product->price * 100),
            'method' => 'PIX',
            'customer' => [
                'name' => $customerData['name'],
                'email' => $customerData['email'],
                'phone' => preg_replace('/\D/', '', $customerData['phone']),
                'documentType' => $documentType,
                'document' => $document,
            ],
            'items' => [[
                'title' => $product->name,
                'amount' => (int) ($product->price * 100),
                'quantity' => 1,
                'tangible' => $product->tipo_produto == 0,
                'externalRef' => (string) $product->id,
            ]],
            'postbackUrl' => route('api.witetec.postback'),
        ];

        $response = Http::withHeaders([
            'x-api-key' => $apiKey, // Usa a chave correta
            'Content-Type' => 'application/json',
        ])->post("{$apiUrl}/transactions", $payload);

        if ($response->failed()) {
            $errorData = $response->json() ?? ['message' => $response->body()];
            Log::error('WiteTec API Error:', [
                'payload' => $payload,
                'status' => $response->status(),
                'response' => $errorData,
            ]);
            throw new \Exception($errorData['message'] ?? 'Falha na comunicação com o gateway de pagamento.');
        }

        $responseData = $response->json('data');

        return [
            'transaction_id' => $responseData['id'],
            'pix_qr_code' => $responseData['pix']['copyPaste'],
        ];
    }

    public function getTransactionStatus(string $transactionId, array $credentials): string
    {
        return 'PENDING';
    }
}
