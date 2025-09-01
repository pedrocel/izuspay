<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\Transaction; // Assumindo que você tenha um model para movimentações
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Para futuras chamadas de API
use Illuminate\Support\Facades\DB;   // Para transações de banco de dados

class FinancialController extends Controller
{
    public function index(Request $request)
    {
        // Aba 1: Saques aguardando aprovação (sem alterações)
        $pendingWithdrawals = Withdrawal::with('wallet.association', 'bankAccount')
            ->where('status', 'pending')
            ->latest()
            ->get();

        // ===================================================================
        // ABA 2: ÚLTIMOS SAQUES (COM FILTROS)
        // ===================================================================
        $processedQuery = Withdrawal::with('wallet.association', 'bankAccount')
            ->whereIn('status', ['completed', 'failed', 'processing']);

        // Filtro de data
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $processedQuery->whereBetween('updated_at', [$request->start_date, $request->end_date]);
        }

        // Filtro de busca por texto (nome, email, etc. da associação)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $processedQuery->whereHas('wallet.association', function ($query) use ($searchTerm) {
                $query->where('nome', 'like', "%{$searchTerm}%")
                      ->orWhere('email', 'like', "%{$searchTerm}%")
                      ->orWhere('documento', 'like', "%{$searchTerm}%");
            });
        }

        $processedWithdrawals = $processedQuery->latest()->paginate(10)->withQueryString();


        // Aba 3: Movimentação do Saldo (sem alterações)
        $movements = Sale::where('status', 'paid')
            ->select('id', 'created_at', 'total_price as amount', DB::raw("'sale' as type"), 'association_id')
            ->latest()
            ->limit(100)
            ->get();

        return view('admin.financial.index', compact(
            'pendingWithdrawals',
            'processedWithdrawals',
            'movements'
        ));
    }

    /**
     * Aprova uma solicitação de saque e inicia o processo de pagamento.
     */
    /**
     * Aprova uma solicitação de saque e inicia o processo de pagamento.
     */
    public function approve(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Este saque não está mais pendente de aprovação.');
        }

        $withdrawal->update(['status' => 'processing']);

        try {
            // LÓGICA DA API DE PIX OUT (COMO NO EXEMPLO ANTERIOR)
            // $response = Http::withToken(...)->post(...);
            // if ($response->successful()) { ... }

            // **CÓDIGO DE SIMULAÇÃO (REMOVER EM PRODUÇÃO)**
            $withdrawal->update(['status' => 'completed']);
            return back()->with('success', "Saque #{$withdrawal->id} aprovado e enviado com sucesso (Simulação).");

        } catch (\Exception $e) {
            $withdrawal->update(['status' => 'failed']);
            // Estornar valor
            $this->refundWallet($withdrawal, 'Erro de API');
            Log::error("Falha na aprovação do saque #{$withdrawal->id}: " . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado ao tentar processar o saque.');
        }
    }

    /**
     * Reprova uma solicitação de saque com um motivo.
     */
    public function reject(Request $request, Withdrawal $withdrawal)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:255',
            'rejection_details' => 'nullable|string|max:1000',
        ]);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Este saque não está mais pendente de aprovação.');
        }

        $reason = $request->rejection_reason;
        if ($reason === 'other' && $request->filled('rejection_details')) {
            $reason = $request->rejection_details;
        }

        // 1. Atualiza o saque com o status de falha e o motivo
        $withdrawal->update([
            'status' => 'failed',
            'notes' => $reason, // Salva o motivo no banco de dados
        ]);

        // 2. Estorna o valor para a carteira do vendedor
        $this->refundWallet($withdrawal, $reason);

        return back()->with('success', "Saque #{$withdrawal->id} reprovado com sucesso. O saldo foi estornado.");
    }

    /**
     * Função auxiliar para estornar o saldo na carteira.
     */
    private function refundWallet(Withdrawal $withdrawal, string $reason)
    {
        $wallet = $withdrawal->wallet;
        $amountToRefund = $withdrawal->amount + 5.00; // Devolve o valor do saque + a taxa de R$5,00
        
        $wallet->balance += $amountToRefund;
        $wallet->save();

        // Opcional: Registrar uma transação de estorno para o extrato do vendedor
        // Transaction::create([...]);
    }
}
