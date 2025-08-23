<?php

namespace App\Http\Controllers;

use App\Models\PerfilModel;
use App\Models\Plan;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product; // Importando modelo Product
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\GoatPaymentController; // Importa o GoatPaymentController
use Illuminate\Http\JsonResponse; // Importa JsonResponse

class CheckoutController extends Controller
{
    /**
     * Método modificado para suportar tanto planos quanto produtos
     * Exibe a página de checkout para um plano ou produto específico.
     *
     * @param string $hash_id O hash ID do plano ou produto.
     * @return \Illuminate\View\View
     */
    public function showCheckout(string $hash_id)
    {
        // Tenta encontrar primeiro como plano
        $plan = Plan::where('hash_id', $hash_id)->with(['association', 'products'])->first();
        
        if ($plan) {
            return view('checkout', compact('plan'))->with('type', 'plan');
        }
        
        // Se não encontrou plano, tenta como produto
        $product = Product::where('hash_id', $hash_id)->with(['association'])->first();

        if ($product) {
            return view('checkout-product', compact('product'))->with('type', 'product');
        }
        
        abort(404, 'Item não encontrado');
    }

    /**
     * Método modificado para processar tanto planos quanto produtos
     * Processa a venda e inicia a transação de pagamento Pix.
     * Retorna uma resposta JSON com os dados do Pix ou erros.
     *
     * @param Request $request Os dados do formulário de checkout.
     * @param string $hash_id O hash ID do plano ou produto.
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeSale(Request $request, string $hash_id): JsonResponse
    {
        // Tenta encontrar primeiro como plano
        $plan = Plan::where('hash_id', $hash_id)->first();
        $product = null;
        
        if (!$plan) {
            // Se não é plano, tenta como produto
            $product = Product::where('hash_id', $hash_id)->first();
            if (!$product) {
                return response()->json(['error' => 'Item não encontrado.'], 404);
            }
        }

        // Remove formatação do documento e telefone
        $document = preg_replace('/\D/', '', $request->document);
        $phone = preg_replace('/\D/', '', $request->phone);

        $goatPaymentController = new GoatPaymentController();

        $requestData = array_merge($request->only(['name', 'email', 'password']), [
            'nome' => $request->name,
            'cpf' => $document,
            'telefone' => $phone,
            'utm_source' => $request->query('utm_source'),
            'utm_medium' => $request->query('utm_medium'),
            'utm_campaign' => $request->query('utm_campaign'),
            'utm_term' => $request->query('utm_term'),
            'utm_content' => $request->query('utm_content'),
            'hash_id' => $request->hash_id,
        ]);

        if ($plan) {
            $requestData['plan_id'] = $plan->id;
            $response = $goatPaymentController->createPixTransaction(Request::create('/', 'GET', $requestData));
            $itemName = $plan->name;
            $totalPrice = $plan->getTotalPriceAttribute();
        } else {
            $requestData['product_id'] = $product->id;
            $response = $goatPaymentController->createProductPixTransaction(Request::create('/', 'GET', $requestData));
            $itemName = $product->name;
            $totalPrice = $product->price;
        }

        $responseData = $response->getData(true);

        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return response()->json([
                'success' => true,
                'message' => 'Transação Pix criada com sucesso!',
                'transaction_hash' => $responseData['hash'],
                'pix_qr_code' => $responseData['pix']['pix_qr_code'],
                'pix_qr_code_image' => $responseData['pix']['pix_qr_code'],
                'item_name' => $itemName,
                'total_price' => $totalPrice * 100, // Convertendo para centavos
            ]);
        } else {
            $errorMessage = $responseData['error'] ?? 'Erro desconhecido ao processar pagamento.';
            \Log::error("Erro no checkout Pix: " . $errorMessage, ['details' => $responseData]);
            
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
