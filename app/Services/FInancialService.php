<?php

namespace App\Services;

use App\Models\LedgerEntry; // MUDANÇA AQUI
use Carbon\Carbon;

class FinancialService
{
    protected $startDate;
    protected $endDate;
    protected $query;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        // A query base agora usa o LedgerEntry
        $this->query = LedgerEntry::whereBetween('created_at', [$this->startDate, $this->endDate]);
    }

    public function getKpiData()
    {
        // Os cálculos agora são feitos sobre os tipos de entrada do livro-razão
        $grossRevenue = (clone $this->query)->where('type', 'sale_revenue')->sum('amount');
        $mdrCost = (clone $this->query)->where('type', 'mdr_cost')->sum('amount');
        $acquirerCost = (clone $this->query)->where('type', 'acquirer_fixed_cost')->sum('amount');
        $whitelabelFee = (clone $this->query)->where('type', 'platform_fee')->sum('amount');
        $interestRevenue = (clone $this->query)->where('type', 'interest_revenue')->sum('amount');

        $netRevenue = $grossRevenue + $mdrCost + $acquirerCost + $whitelabelFee + $interestRevenue;
        $netMargin = ($grossRevenue > 0) ? ($netRevenue / $grossRevenue) * 100 : 0;

        return [
            'gross_revenue' => $grossRevenue,
            'net_margin' => $netMargin,
            'mdr_received' => 0, // Este valor viria de um tipo específico de entrada
            'interest_received' => $interestRevenue,
            'acquirer_fixed_cost' => $acquirerCost,
            'whitelabel_fee' => $whitelabelFee,
            'mdr_cost' => $mdrCost,
            'net_revenue' => $netRevenue,
        ];
    }

    public function getMovements($limit = 100)
    {
        // A lista de movimentações também vem do LedgerEntry
        return (clone $this->query)->with('association')->latest()->paginate($limit)->withQueryString();
    }
}
