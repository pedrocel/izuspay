<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\Wallet;
use App\Models\BankAccount;
use App\Http\Requests\WithdrawalRequest;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        $associationId = auth()->user()->association_id;
        $withdrawals = Withdrawal::whereHas('wallet', function($q) use ($associationId) {
            $q->where('association_id', $associationId);
        })->with('bankAccount')->latest()->paginate(10);
        
        $bankAccounts = BankAccount::where('association_id', $associationId)->where('is_active', true)->get();

        return view('associacao.financeiro._withdrawals', compact('withdrawals', 'bankAccounts'));
    }

    public function store(WithdrawalRequest $request)
    {
        $wallet = Wallet::where('association_id', auth()->user()->association_id)->first();
        $withdrawalAmount = $request->amount;
        $minWithdrawal = 50.00;
        $withdrawalFee = 5.00;

        // 1. Verificação de Saldo e Saque Mínimo
        if (!$wallet || $wallet->balance < $withdrawalAmount) {
            return back()->with('error', 'Saldo insuficiente para realizar o saque.');
        }

        if ($withdrawalAmount < $minWithdrawal) {
            return back()->with('error', 'O valor mínimo para saque é de R$ 50,00.');
        }
        
        // 2. Cria o saque e deduz o valor do saldo
        $amountToDeduct = $withdrawalAmount + $withdrawalFee;
        
        if ($wallet->balance < $amountToDeduct) {
             return back()->with('error', 'Saldo insuficiente para cobrir o valor do saque e a taxa.');
        }

        $wallet->balance -= $amountToDeduct;
        $wallet->save();
        
        Withdrawal::create([
            'wallet_id' => $wallet->id,
            'bank_account_id' => $request->bank_account_id,
            'amount' => $withdrawalAmount,
            'status' => 'pending',
        ]);

        return redirect()->route('associacao.financeiro.index')->with('success', 'Saque solicitado com sucesso! Aguardando processamento.');
    }

    public function updateStatus(Request $request, Withdrawal $withdrawal)
    {
        // Esta lógica seria para o admin do sistema, não para o dono da associação
        // Mas podemos ter uma forma de cancelar
        abort_if($withdrawal->wallet->association_id !== auth()->user()->association_id, 403, 'Acesso negado.');

        $request->validate(['status' => ['required', 'string', 'in:cancelled']]);
        
        $withdrawal->update(['status' => 'cancelled']);
        
        // Reembolsar o saldo
        $wallet = $withdrawal->wallet;
        $wallet->balance += $withdrawal->amount;
        $wallet->save();

        return back()->with('success', 'Saque cancelado e saldo estornado com sucesso.');
    }
}