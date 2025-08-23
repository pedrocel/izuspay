<?php

namespace App\Http\Controllers;

use App\Models\PerfilModel;
use App\Models\Plan;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\GoatPaymentController; // Importa o GoatPaymentController
use Illuminate\Http\JsonResponse; // Importa JsonResponse

class CheckoutController extends Controller
{
    /**
     * Exibe a página de checkout para um plano específico.
     *
     * @param string $hash_id O hash ID do plano.
     * @return \Illuminate\View\View
     */
    public function showCheckout(string $hash_id)
    {
        $plan = Plan::where('hash_id', $hash_id)
            ->with(['association', 'products'])
            ->firstOrFail();

        return view('checkout', compact('plan'));
    }

    /**
     * Processa a venda e inicia a transação de pagamento Pix.
     * Retorna uma resposta JSON com os dados do Pix ou erros.
     *
     * @param Request $request Os dados do formulário de checkout.
     * @param string $hash_id O hash ID do plano.
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeSale(Request $request, string $hash_id): JsonResponse
    {
        $plan = Plan::where('hash_id', $hash_id)->firstOrFail();

        // Remove formatação do documento e telefone para enviar à API
        $document = preg_replace('/\D/', '', $request->document);
        $phone = preg_replace('/\D/', '', $request->phone);

        // Instancia o GoatPaymentController
        $goatPaymentController = new GoatPaymentController();

        // Prepara uma nova Request para o GoatPaymentController
        // Passamos todos os dados necessários para que ele crie/atualize o User e a Sale
        $goatRequest = Request::create(
            '/api/goat-payments/create-pix-transaction', // Rota interna fictícia
            'GET', // Método que o createPixTransaction espera
            array_merge($request->only(['name', 'email', 'password']), [ // Inclui a senha para criação do usuário
                'nome' => $request->name,
                'cpf' => $document,
                'telefone' => $phone,
                'plan_id' => $plan->id,
                // Inclui UTMs se existirem na URL original do checkout
                'utm_source' => $request->query('utm_source'),
                'utm_medium' => $request->query('utm_medium'),
                'utm_campaign' => $request->query('utm_campaign'),
                'utm_term' => $request->query('utm_term'),
                'utm_content' => $request->query('utm_content'),
            ])
        );
        
        // Chama o método createPixTransaction do GoatPaymentController
        $response = $goatPaymentController->createPixTransaction($goatRequest);
        $responseData = $response->getData(true); // Obtém os dados da resposta

        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            // Sucesso na criação da transação Pix
            return response()->json([
                'success' => true,
                'message' => 'Transação Pix criada com sucesso!',
                'transaction_hash' => $responseData['hash'],
                'pix_qr_code' => $responseData['pix']['pix_qr_code'],
                'pix_qr_code_image' => $responseData['pix']['pix_qr_code'],
                'plan_name' => $plan->name,
                'total_price' => $plan->getTotalPriceAttribute(), // Preço em centavos
            ]);

        } else {
            // Erro na criação da transação Pix
            $errorMessage = $responseData['error'] ?? 'Erro desconhecido ao processar pagamento.';
            \Log::error("Erro no checkout Pix (GoatPaymentController): " . $errorMessage, ['details' => $responseData]);
            
            return response()->json([
                'success' => false,
                'message' => $errorMessage,
                'errors' => $responseData['details'] ?? []
            ], $response->getStatusCode());
        }
    }

    /**
     * Exibe a página de sucesso após a compra.
     * (Mantido caso você queira uma página de sucesso final após o Pix ser pago)
     *
     * @param \App\Models\Sale $sale O modelo da venda.
     * @return \Illuminate\View\View
     */
    public function showSuccess(Sale $sale)
    {
        $sale->load(['user', 'plan', 'association']);
        return view('checkout-success', compact('sale'));
    }

    // O método showPixPayment não é mais necessário aqui, pois a lógica foi mesclada na view de checkout.
}
