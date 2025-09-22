<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.witetec.url');
        $this->apiKey = config('services.witetec.key');
    }

    /**
     * Orquestra a criação do usuário, da venda e da transação de pagamento.
     *
     * @param Product $product O produto sendo comprado.
     * @param array $customerData Dados do cliente.
     * @return array Dados da transação para o frontend.
     * @throws \Exception Se qualquer etapa falhar.
     */
    public function createTransaction(Product $product, array $customerData): array
    {
        // Envolve todo o processo em uma transação de banco de dados.
        // Se algo falhar, tudo é desfeito (rollback).
        return DB::transaction(function () use ($product, $customerData) {
            
            // 1. Cria ou encontra o usuário. Se não existir, cria com os dados do formulário.
            $user = User::firstOrCreate(
                ['email' => $customerData['email']],
                [
                    'name' => $customerData['name'],
                    'phone' => preg_replace('/\D/', '', $customerData['phone']),
                    'documento' => preg_replace('/\D/', '', $customerData['document']),
                    'password' => Hash::make($customerData['password']),
                    'association_id' => $product->association_id,
                    'tipo' => 'cliente',
                    'status' => 'active',
                ]
            );

            // 2. Cria o registro da venda com status pendente ANTES de chamar a API.
            $sale = Sale::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'association_id' => $product->association_id,
                'status' => 'awaiting_payment', // Status inicial correto
                'total_price' => $product->price,
                'payment_method' => 'pix',
                // O transaction_hash será preenchido após a resposta da API
            ]);

            // 3. Chama a API da WiteTec para gerar o PIX
            $witetecResponse = $this->callWiteTecApi($product, $customerData);

            // 4. Atualiza a venda que acabamos de criar com o ID da transação da WiteTec
            $sale->update([
                'transaction_hash' => $witetecResponse['data']['id'],
            ]);

            // 5. Retorna os dados para o frontend
            return [
                'transaction_hash' => $witetecResponse['data']['id'],
                'pix_qr_code' => $witetecResponse['data']['pix']['copyPaste'],
            ];
        });
    }

    /**
     * Faz a chamada para a API da WiteTec.
     */
    private function callWiteTecApi(Product $product, array $customerData): array
    {
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
            'x-api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post("{$this->apiUrl}/transactions", $payload);

        if ($response->failed() || (isset($response->json()['status']) && $response->json()['status'] === false)) {
            $errorData = $response->json();
            $errorMessage = $errorData['message'] ?? 'Falha na comunicação com o gateway de pagamento.';
            Log::error('WiteTec API Error:', ['payload' => $payload, 'response' => $errorData]);
            // Esta exceção irá acionar o DB::rollBack() automaticamente
            throw new \Exception($errorMessage);
        }

        return $response->json();
    }
}
