<?php

namespace App\Services\Gateways;

use App\Models\Raffle;

interface RaffleGatewayInterface
{
    /**
     * Cria uma cobrança no gateway de pagamento para rifas.
     *
     * @param Raffle $raffle A rifa sendo vendida.
     * @param int $quantity Quantidade de bilhetes.
     * @param array $customerData Dados do cliente.
     * @param array $credentials Credenciais do gateway.
     * @return array ['transaction_id' => '...', 'pix_qr_code' => '...']
     */
    public function createCharge(Raffle $raffle, int $quantity, array $customerData, array $credentials): array;

    /**
     * Consulta o status de uma transação.
     *
     * @param string $transactionId
     * @param array $credentials
     * @return string Status da transação
     */
    public function getTransactionStatus(string $transactionId, array $credentials): string;
}
