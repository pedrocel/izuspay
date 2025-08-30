<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerfilModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Plan;
use App\Models\User;
use App\Models\Sale;
use App\Models\Subscription;
use App\Models\UserPerfilModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Importar Hash
use App\Models\Product; // Importando modelo Product

class GoatPaymentController extends Controller
{
    private $apiToken;
    private $apiUrl;

    public function __construct()
    {
        $this->apiToken = env('GOAT_API_TOKEN', 'POZyVZ3yHrnHXZ9RNaKcsRpS4wcjWf6A3StWKXz07HlGVXs0xz5aCBAgB4QC');
        $this->apiUrl = env('GOAT_API_URL', 'https://api.goatpayments.com.br/api/public/v1/transactions');
    }

    /**
     * Inicia uma nova transação Pix na Goat Payments.
     *
     * @param Request $request Espera 'nome', 'cpf', 'telefone', 'plan_id', 'email', 'password'
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPixTransaction(Request $request)
    {
       
        $plan = Plan::find($request->plan_id);

        if (!$plan) {
            return response()->json(['error' => 'Plano não encontrado.'], 404);
        }

        DB::beginTransaction();
        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->telefone,
                'tipo' => 'cliente',
                'password' => Hash::make($request->password),
                'association_id' => $plan->association_id,
                'documento' => $request->cpf,
                'status' => 'active',
            ]);

            UserPerfilModel::create([
                'user_id' => $user->id,
                'perfil_id' => 3,
                'is_atual' => 1,
                'status' => 1,
            ]);

            $perfilClienteId = 3;
            $perfilCliente = PerfilModel::find($perfilClienteId);


            $data = [
                "amount" => ((int) round($plan->getTotalPriceAttribute() * 100)),
                "offer_hash" => $plan->offer_hash,
                "payment_method" => "pix",
                "customer" => [
                    "name" => $request->nome,
                    "email" => $request->email, // Usar o email real do cliente
                    "phone_number" => $request->telefone,
                    "document" => $request->cpf,
                    // Endereço pode ser gerado aleatoriamente ou obtido se o cliente já tiver um cadastro
                    "street_name" => "Rua Exemplo",
                    "number" => "123",
                    "complement" => "",
                    "neighborhood" => "Bairro Teste",
                    "city" => "Cidade Exemplo",
                    "state" => "SP",
                    "zip_code" => "00000000"
                ],
                "cart" => [
                    [
                        "product_hash" => $plan->product_hash,
                        "title" => $plan->name,
                        "price" => ((int) round($plan->getTotalPriceAttribute() * 100)),
                        "quantity" => 1,
                        "operation_type" => 1,
                        "tangible" => true
                    ]
                ],
                "tracking" => [
                    "utm_source" => $request->query('utm_source', ''),
                    "utm_medium" => $request->query('utm_medium', ''),
                    "utm_campaign" => $request->query('utm_campaign', ''),
                    "utm_term" => $request->query('utm_term', ''),
                    "utm_content" => $request->query('utm_content', '')
                ],
                "installments" => 1,
                "expire_in_days" => 1,
                "postback_url" => 'https://google.com',
            ];

            // Envia a requisição para a API da Goat Payments
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl . '?api_token=' . $this->apiToken, $data);


            $responseData = $response->json();

            if ($response->successful()) {
                Log::info('Transação Pix criada com sucesso na Goat Payments:', $responseData);

                $sale = Sale::create([
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'transaction_hash' => $responseData['hash'],
                    'status' => 'awaiting_payment', // Status inicial
                    'total_price' => $plan->getTotalPriceAttribute(),
                    'payment_method' => 'pix',
                    'association_id' => $plan->association_id,
                ]);

                DB::commit();
                return response()->json($responseData);
            } else {
                DB::rollBack();
                Log::error('Erro ao criar transação Pix na Goat Payments:', [
                    'status' => $response->status(),
                    'response' => $responseData
                ]);
                return response()->json([
                    'error' => 'Falha ao se comunicar com a API de pagamento.',
                    'details' => $responseData
                ], $response->status());
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Exceção ao chamar API da Goat Payments ou salvar dados:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Erro interno ao processar a requisição.', $e], 500);
        }
    }

    /**
     * Novo método para criar transação PIX para produtos individuais
     */
    public function createProductPixTransaction(Request $request)
    {
        $product = Product::where('hash_id', $request->hash_id)->first();

        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado.'], 404);
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->telefone,
                'tipo' => 'cliente',
                'password' => Hash::make($request->password),
                'association_id' => $product->association_id,
                'documento' => $request->cpf,
                'status' => 'active',
            ]);

            UserPerfilModel::create([
                'user_id' => $user->id,
                'perfil_id' => 3,
                'is_atual' => 1,
                'status' => 1,
            ]);

            $data = [
                "amount" => ((int) round($product->price * 100)),
                "offer_hash" => $product->offer_hash_goat,
                "payment_method" => "pix",
                "customer" => [
                    "name" => $request->nome,
                    "email" => $request->email,
                    "phone_number" => $request->telefone,
                    "document" => $request->cpf,
                    "street_name" => "Rua Exemplo",
                    "number" => "123",
                    "complement" => "",
                    "neighborhood" => "Bairro Teste",
                    "city" => "Cidade Exemplo",
                    "state" => "SP",
                    "zip_code" => "00000000"
                ],
                "cart" => [
                    [
                        "product_hash" => $product->product_hash_goat,
                        "title" => $product->name,
                        "price" => ((int) round($product->price * 100)),
                        "quantity" => 1,
                        "operation_type" => 1,
                        "tangible" => true
                    ]
                ],
                "tracking" => [
                    "utm_source" => $request->query('utm_source', ''),
                    "utm_medium" => $request->query('utm_medium', ''),
                    "utm_campaign" => $request->query('utm_campaign', ''),
                    "utm_term" => $request->query('utm_term', ''),
                    "utm_content" => $request->query('utm_content', '')
                ],
                "installments" => 1,
                "expire_in_days" => 1,
                "postback_url" => 'https://google.com',
            ];

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl . '?api_token=' . $this->apiToken, $data);

            $responseData = $response->json();


            if ($response->successful()) {

                $sale = Sale::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'transaction_hash' => $responseData['hash'],
                    'status' => 'awaiting_payment',
                    'total_price' => $product->price,
                    'payment_method' => 'pix',
                    'association_id' => $product->association_id,
                ]);

                DB::commit();
                return response()->json($responseData);
            } else {
                DB::rollBack();
                Log::error('Erro ao criar transação Pix para produto:', [
                    'status' => $response->status(),
                    'response' => $responseData
                ]);
                return response()->json([
                    'error' => 'Falha ao se comunicar com a API de pagamento.',
                    'details' => $responseData
                ], $response->status());
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Exceção ao processar produto:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Erro interno ao processar a requisição.'], 500);
        }
    }

    /**
     * Verifica o status de uma transação Pix na Goat Payments.
     *
     * @param Request $request Espera 'transaction_hash' na URL
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkTransactionStatus(Request $request)
    {
        $request->validate([
            'transaction_hash' => 'required|string',
        ]);

        $transactionHash = $request->transaction_hash;
        $url = $this->apiUrl . '/' . $transactionHash . '?api_token=' . $this->apiToken;

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get($url);

            $responseData = $response->json();

            if ($response->successful()) {
                // Verifica se a transação existe na base
                $sale = Sale::where('transaction_hash', $transactionHash)->first();

                if (!$sale) {
                    return response()->json([
                        'error' => 'Venda não encontrada para este transaction_hash.'
                    ], 404);
                }

                if (isset($responseData['payment_status'])) {
                    $paymentStatus = $responseData['payment_status'];

                    // Atualiza o status da venda no banco
                    $sale->status = $paymentStatus;
                    $sale->save();

                    // Se foi pago, cria/atualiza assinatura
                    if ($paymentStatus === 'paid' && $sale->plan_id) {

                        $sale->status = 'paid';
                        $sale->save();


                        $this->createOrUpdateSubscription($sale);
                    }

                    return response()->json(['status' => $paymentStatus]);
                }

                return response()->json(['status' => 'waiting_payment']);
            } else {
                Log::error('Erro ao verificar status da transação:', [
                    'status' => $response->status(),
                    'response' => $responseData
                ]);
                return response()->json([
                    'error' => 'Erro ao verificar o status do pagamento.',
                    'details' => $responseData
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Exceção ao verificar status da transação:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Erro interno ao verificar o status.'], 500);
        }
    }


    /**
     * Endpoint para receber postbacks da Goat Payments.
     *
     * @param Request $request Os dados do postback enviados pela Goat Payments
     * @return \Illuminate\Http\Response
     */
    public function handlePostback(Request $request)
    {
        Log::info('Postback da Goat Payments recebido:', $request->all());

        $transactionHash = $request->input('transaction_hash');
        $paymentStatus = $request->input('payment_status');

        if (!$transactionHash || !$paymentStatus) {
            Log::warning('Postback inválido: falta transaction_hash ou payment_status.', $request->all());
            return response('Bad Request: Missing parameters', 400);
        }

        try {
            DB::beginTransaction();
            $sale = Sale::where('transaction_hash', $transactionHash)->first();

            if ($sale) {
                $sale->status = $paymentStatus;
                $sale->save();
                Log::info("Status da venda {$transactionHash} atualizado para {$paymentStatus}.");

                if ($paymentStatus === 'paid' && $sale->plan_id) {
                    $this->createOrUpdateSubscription($sale);
                }
                
                DB::commit();
                return response('OK', 200);
            } else {
                DB::rollBack();
                Log::warning("Venda com hash {$transactionHash} não encontrada.");
                return response('Not Found', 404);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao processar postback:', [
                'transaction_hash' => $transactionHash,
                'error' => $e->getMessage(),
            ]);
            return response('Internal Server Error', 500);
        }
    }

    /**
     * Cria ou atualiza uma assinatura após o pagamento.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    private function createOrUpdateSubscription(Sale $sale)
    {
        if ($sale->user && $sale->plan) {
            $subscription = Subscription::where('user_id', $sale->user_id)
                                        ->where('plan_id', $sale->plan_id)
                                        ->first();

            if ($subscription) {
                $subscription->renews_at = now()->addMonths($sale->plan->duration_in_months ?? 1);
                $subscription->status = 'active';
                $subscription->sale_id = $sale->id; // Vincula à venda mais recente
                $subscription->external_transaction_id = $sale->transaction_hash;
                $subscription->save();
                Log::info("Assinatura para o usuário {$sale->user_id} e plano {$sale->plan_id} atualizada.");
            } else {
                Subscription::create([
                    'user_id' => $sale->user_id,
                    'plan_id' => $sale->plan_id,
                    'association_id' => $sale->association_id,
                    'sale_id' => $sale->id,
                    'status' => 'active',
                    'starts_at' => now(),
                    'renews_at' => now()->addMonths($sale->plan->duration_in_months ?? 1),
                    'external_transaction_id' => $sale->transaction_hash,
                ]);
                Log::info("Nova assinatura criada para o usuário {$sale->user_id} e plano {$sale->plan_id}.");
            }
        } else {
            Log::warning("Não foi possível criar/atualizar assinatura: venda, usuário ou plano ausente na venda.");
        }
    }
}
