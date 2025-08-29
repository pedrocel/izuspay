<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Filters\SaleFilter; // Importar o SaleFilter

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Filtros de Data e outros filtros
        $startDate = Carbon::parse($request->input('start_date', Carbon::now()->subDays(30)))->startOfDay();
        $endDate = Carbon::parse($request->input('end_date', Carbon::now()))->endOfDay();

        // Instancia o filtro e aplica à query base
        $salesQuery = Sale::query()->betweenDates($startDate, $endDate);
        $filter = new SaleFilter($request);
        $salesQuery = $filter->apply($salesQuery);

        // 2. Consultas Principais para os Cards (KPIs) - Utilizando escopos
        $totalRevenue = (clone $salesQuery)->sum('total_price');
        $paidRevenue = (clone $salesQuery)->whereStatus('paid')->sum('total_price');
        $pendingRevenue = (clone $salesQuery)->whereStatus('awaiting_payment')->sum('total_price');
        $refundedRevenue = (clone $salesQuery)->whereStatus('refunded')->sum('total_price');
        $chargebackRevenue = (clone $salesQuery)->whereStatus('chargeback')->sum('total_price');
        $refusedRevenue = (clone $salesQuery)->whereStatus('refused')->sum('total_price');

        // 3. Dados para o Gráfico de Vendas Diárias - Utilizando escopo
        // Para o gráfico, geralmente queremos apenas vendas pagas e não aplicamos todos os filtros gerais
        $dailySales = Sale::query()->betweenDates($startDate, $endDate)->forDailyChart()->get();

        $chartLabels = $dailySales->pluck('date')->map(fn ($date) => Carbon::parse($date)->format('d/m'));
        $chartValues = $dailySales->pluck('total');

        // 4. Dados para a Tabela de Transações Recentes - Utilizando escopos e o filtro
        $recentTransactions = Sale::query()
            ->withRelations()
            ->latest()
            ->limit(10) // Limite para a tabela de recentes, mas o filtro pode ser aplicado antes
            ->get();

        // 5. Enviando os dados para a View
        return view('admin.dashboard', [
            // KPIs para os cards
            'totalRevenue' => $totalRevenue,
            'paidRevenue' => $paidRevenue,
            'pendingRevenue' => $pendingRevenue,
            'refundedRevenue' => $refundedRevenue,
            'chargebackRevenue' => $chargebackRevenue,
            'refusedRevenue' => $refusedRevenue,

            // Dados para o gráfico
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,

            // Dados para a tabela
            'recentTransactions' => $recentTransactions,

            // Datas do filtro para exibir na interface
            'startDate' => $startDate->format('Y-m-d'),
            'endDate' => $endDate->format('Y-m-d'),
            'request' => $request, // Passa o objeto request para a view para preencher os filtros
        ]);
    }
}


