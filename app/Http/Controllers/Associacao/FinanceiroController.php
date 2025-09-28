<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Fee;
use App\Models\Sale;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function index()
    {
        $associationId = auth()->user()->association_id;
        
        $wallet = Wallet::firstOrCreate(['association_id' => $associationId], ['balance' => 0]);

        $totalRevenue = Sale::where('association_id', $associationId)->where('status', 'paid')->sum('total_price');
        $pendingRevenue = Sale::where('association_id', $associationId)->where('status', 'awaiting_payment')->sum('total_price');
        
        $totalWithdrawals = Withdrawal::whereHas('wallet', function($q) use ($associationId) {
            $q->where('association_id', $associationId);
        })->where('status', 'completed')->sum('amount');
        
        $pendingWithdrawals = Withdrawal::whereHas('wallet', function($q) use ($associationId) {
            $q->where('association_id', $associationId);
        })->where('status', 'pending')->sum('amount');

        $recentSales = Sale::where('association_id', $associationId)->with(['user', 'plan'])->latest()->take(5)->get();
        
        $fees = Fee::where('association_id', $associationId)->get();
        
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
            'bankAccounts',
            'withdrawals',
            'fees'
        ));
    }
}