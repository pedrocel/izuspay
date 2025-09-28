<?php

namespace App\Services\Gateways;

use App\Models\Product;

interface GatewayInterface
{
    /**
     * Cria uma cobrança no gateway de pagamento.
     *
     * @param Product $product O produto sendo vendido.
     * @param array $customerData Dados do cliente final.
     * @param array $credentials Credenciais do vendedor para este gateway.
     * @return array Deve retornar um array com dados da transação, como ['transaction_id' => '...', 'pix_qr_code' => '...'].
     */
    public function createCharge(Product $product, array $customerData, array $credentials): array;

    /**
     * Consulta o status de uma transação no gateway.
     * (Opcional por agora, mas bom já ter no contrato)
     *
     * @param string $transactionId
     * @param array $credentials
     * @return string Retorna o status (ex: 'PAID', 'PENDING').
     */
    public function getTransactionStatus(string $transactionId, array $credentials): string;
}
