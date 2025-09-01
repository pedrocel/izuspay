<?php

namespace App\Services;

use App\Models\LedgerEntry;
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
        $this->query = LedgerEntry::whereBetween('created_at', [$this->startDate, $this->endDate]);
    }

    public function getKpiData()
    {
        // ===================================================================
        // LÓGICA DE KPI CORRIGIDA E SIMPLIFICADAs
        // ===================================================================

        // 1. Calcula a receita bruta total das vendas
        $grossRevenue = (clone $this->query)->where('type', 'sale_revenue')->sum('amount');

        // 2. Calcula a RECEITA DA PLATAFORMA (seu lucro) somando as taxas
        // O valor no banco é negativo (-50), então usamos abs() para torná-lo positivo (50)
        $platformRevenue = abs((clone $this->query)->where('type', 'platform_fee')->sum('amount'));

        // 3. Calcula os outros custos (apenas para exibição nos cards menores)
        $acquirerCost = (clone $this->query)->where('type', 'acquirer_fixed_cost')->sum('amount');
        $mdrCost = (clone $this->query)->where('type', 'mdr_cost')->sum('amount');

        // Calcula a margem apenas para referência
        $netMargin = ($grossRevenue > 0) ? ($platformRevenue / $grossRevenue) * 100 : 0;

        return [
            'gross_revenue'       => $grossRevenue,
            'platform_revenue'    => $platformRevenue, // << A VARIÁVEL CORRETA PARA O SEU LUCRO
            'net_margin'          => $netMargin,
            'acquirer_fixed_cost' => $acquirerCost,
            'mdr_cost'            => $mdrCost,
            
            // Mantendo outros campos para não quebrar a view, mesmo que zerados por enquanto
            'mdr_received'        => 0, 
            'interest_received'   => 0,
            'whitelabel_fee'      => 0,
        ];
    }

    public function getMovements($limit = 100)
    {
        return (clone $this->query)->with('association')->latest()->paginate($limit)->withQueryString();
    }
}
