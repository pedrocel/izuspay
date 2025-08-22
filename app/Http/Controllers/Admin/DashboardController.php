<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionModel;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $assinaturas = SubscriptionModel::all();

        $totalAssinaturas = $assinaturas->count();
        $assinaturasAtivas = $assinaturas->where('status', 'ativa')->count();
        $assinaturasCanceladas = $assinaturas->where('status', 'cancelada')->count();
        $receitaTotal = $assinaturas->sum('price');

        $faturamentoDiario = $assinaturas->where('paid_at', '>=', Carbon::today())->sum('price');
        $faturamentoMensal = $assinaturas->where('paid_at', '>=', Carbon::now()->startOfMonth())->sum('price');

        $assinaturasPorMes = $assinaturas->groupBy(function ($assinatura) {
            return Carbon::parse($assinatura->paid_at)->format('Y-m');
        });

        $graficoLabels = $assinaturasPorMes->keys();
        $graficoValores = $assinaturasPorMes->map(fn($assinaturas) => $assinaturas->count());

        return view('admin.dashboard', compact(
            'totalAssinaturas',
            'assinaturasAtivas',
            'assinaturasCanceladas',
            'receitaTotal',
            'faturamentoDiario',
            'faturamentoMensal',
            'graficoLabels',
            'graficoValores'
        ));
    }
}
