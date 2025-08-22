<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Sale;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function index()
    {
        $associationId = auth()->user()->association_id;
        
        // Obter o saldo da carteira
        $wallet = Wallet::firstOrCreate(['association_id' => $associationId], ['balance' => 0]);

        // Métricas de Vendas
        $totalRevenue = Sale::where('association_id', $associationId)->where('status', 'paid')->sum('total_price');
        $pendingRevenue = Sale::where('association_id', $associationId)->where('status', 'awaiting_payment')->sum('total_price');
        
        // Métricas de Saques
        $totalWithdrawals = Withdrawal::whereHas('wallet', function($q) use ($associationId) {
            $q->where('association_id', $associationId);
        })->where('status', 'completed')->sum('amount');
        
        $pendingWithdrawals = Withdrawal::whereHas('wallet', function($q) use ($associationId) {
            $q->where('association_id', $associationId);
        })->where('status', 'pending')->sum('amount');

        // Vendas Recentes
        $recentSales = Sale::where('association_id', $associationId)->with(['user', 'plan'])->latest()->take(5)->get();
        
        // **Correção:** Buscar as contas bancárias e saques para as abas
        $bankAccounts = BankAccount::where('association_id', $associationId)->get();
        $withdrawals = Withdrawal::whereHas('wallet', function($q) use ($associationId) {
            $q->where('association_id', $associationId);
        })->with('bankAccount')->latest()->paginate(10);
        
        return view('associacao.financeiro.index', compact(
            'wallet',
            'totalRevenue',
            'pendingRevenue',
            'totalWithdrawals',
            'pendingWithdrawals',
            'recentSales',
            'bankAccounts', // Variável adicionada
            'withdrawals' // Variável adicionada
        ));
    }
}