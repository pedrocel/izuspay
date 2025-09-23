<?php

use App\Http\Controllers\Api\GoatPaymentController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/webhook-cakto', [WebhookController::class, 'handle'])->name('webhook.handle');
Route::post('/webhook-kiwify', [WebhookController::class, 'kiwify'])->name('webhook.kiwify');


Route::get('/goat-payments/check-transaction-status', [CheckoutController::class, 'checkTransactionStatus'])->name('api.goat.check_status');

// Certifique-se também que a rota para criar a transação Pix está presente:
Route::post('/goat-payments/create-pix-transaction', [GoatPaymentController::class, 'createPixTransaction'])->name('api.goat.create_pix');

// E a rota de postback da Goat Payments:
Route::post('/goat-payments/postback', [GoatPaymentController::class, 'handlePostback'])->name('api.goat.postback');

Route::post('/witetec/postback', [CheckoutController::class, 'handlePostback'])->name('api.witetec.postback');


