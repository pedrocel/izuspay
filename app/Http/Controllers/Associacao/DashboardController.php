<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Plan;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Importar a facade DB

class DashboardController extends Controller
{
    public function index()
    {
        $associationId = auth()->user()->association_id;

        $userLayout = auth()->user()->dashboardSetting->layout ?? null;

    // Layout Padrão (se o usuário nunca salvou um)
    $defaultLayout = [
        'totalUsers' => ['visible' => true, 'size' => 'col-span-1'],
        'totalMembers' => ['visible' => true, 'size' => 'col-span-1'],
        'totalRevenue' => ['visible' => true, 'size' => 'col-span-1'],
        'pendingRevenue' => ['visible' => true, 'size' => 'col-span-1'],
        'revenueChart' => ['visible' => true, 'size' => 'col-span-1 lg:col-span-2'],
        'newMembersChart' => ['visible' => true, 'size' => 'col-span-1 lg:col-span-2'],
        'averageTicket' => ['visible' => true, 'size' => 'col-span-1'],
        'onboardingConversionRate' => ['visible' => true, 'size' => 'col-span-1'],
        'activeMembers' => ['visible' => true, 'size' => 'col-span-1'],
        'inactiveMembers' => ['visible' => true, 'size' => 'col-span-1'],
        'recentActivity' => ['visible' => true, 'size' => 'col-span-1 lg:col-span-2'],
        'gamificationLevel' => ['visible' => true, 'size' => 'col-span-1'],
    ];

    // Mescla o layout do usuário com o padrão para garantir que novos cards apareçam
    $layout = $userLayout ? array_merge($defaultLayout, $userLayout) : $defaultLayout;

    $userLayoutConfig = auth()->user()->dashboardSetting->layout ?? [];
    // Reordena os cards com base na ordem salva pelo usuário, se existir
    if ($userLayout) {
        $layout = array_replace(array_flip(array_keys($userLayout)), $layout);
    }

        $totalRevenue = Sale::where('association_id', $associationId)->where('status', 'paid')->sum('total_price');

        // ==================================================
        // === NOVA LÓGICA DE GAMIFICAÇÃO ===
        // ==================================================
        $revenueForLevel = $totalRevenue; // Usando a receita total da associação

        $levels = [
            1 => ['min' => 0,       'max' => 10000,    'name' => 'Semente', 'badge' => 'seedling'],
            2 => ['min' => 10000,   'max' => 100000,   'name' => 'Bronze',  'badge' => 'bronze-medal'],
            3 => ['min' => 100000,  'max' => 500000,   'name' => 'Prata',   'badge' => 'silver-medal'],
            4 => ['min' => 500000,  'max' => 1000000,  'name' => 'Ouro',    'badge' => 'gold-medal'],
            5 => ['min' => 1000000, 'max' => 5000000,  'name' => 'Platina', 'badge' => 'platinum-trophy'],
            6 => ['min' => 5000000, 'max' => PHP_INT_MAX, 'name' => 'Diamante', 'badge' => 'diamond-gem'],
        ];

        $currentLevelInfo = null;
        foreach ($levels as $level => $info) {
            if ($revenueForLevel >= $info['min']) {
                $currentLevelInfo = $info;
                $currentLevelInfo['level'] = $level;
            } else {
                break; // Para no nível correto
            }
        }

        // Calcular o progresso para o próximo nível
        $nextLevelMin = $levels[$currentLevelInfo['level'] + 1]['min'] ?? $currentLevelInfo['max'];
        $currentLevelMin = $currentLevelInfo['min'];

        $range = $nextLevelMin - $currentLevelMin;
        $progress = $revenueForLevel - $currentLevelMin;
        
        // Evita divisão por zero e progresso acima de 100%
        $progressPercentage = ($range > 0) ? min(100, ($progress / $range) * 100) : 100;

        $gamificationData = [
            'levelName' => $currentLevelInfo['name'],
            'levelBadge' => $currentLevelInfo['badge'], // Ícone para o selo
            'currentRevenue' => $revenueForLevel,
            'nextLevelTarget' => $nextLevelMin,
            'progressPercentage' => $progressPercentage,
        ];

        // === MÉTRICAS DE USUÁRIOS E PERFIS (EXISTENTES) ===
        $totalUsers = User::where('association_id', $associationId)->count();
        $totalMembers = User::comPerfil('Membro')->where('association_id', $associationId)->count();
        $totalClients = User::comPerfil('Cliente')->where('association_id', $associationId)->count();

        // === MÉTRICAS DO FUNIL DE ONBOARDING (EXISTENTES) ===
        $docsPendingUploadCount = User::where('association_id', $associationId)->where('status', 'documentation_pending')->count();
        $docsUnderReviewCount = User::where('association_id', $associationId)->where('status', 'docs_under_review')->count();
        $paymentPendingCount = User::where('association_id', $associationId)->where('status', 'payment_pending')->count();
        
        // === MÉTRICAS DE VENDAS (EXISTENTES) ===
        $totalRevenue = Sale::where('association_id', $associationId)->where('status', 'paid')->sum('total_price');
        $pendingRevenue = Sale::where('association_id', $associationId)->where('status', 'awaiting_payment')->sum('total_price');
        $activePlans = Plan::where('association_id', $associationId)->where('is_active', true)->count();
        $totalPlans = Plan::where('association_id', $associationId)->count();

        // === MÉTRICAS DE CONTEÚDO (EXISTENTES) ===
        $publishedNews = News::where('association_id', $associationId)->published()->count();
        $draftNews = News::where('association_id', $associationId)->draft()->count();

        // === ATIVIDADE RECENTE (EXISTENTE) ===
        $recentSales = Sale::where('association_id', $associationId)
                           ->with(['user', 'plan'])
                           ->latest()
                           ->take(5)
                           ->get();
        
        // ==================================================
        // === NOVOS INDICADORES SUGERIDOS ===
        // ==================================================

        // 1. TICKET MÉDIO POR VENDA
        $averageTicket = Sale::where('association_id', $associationId)
                               ->where('status', 'paid')
                               ->avg('total_price') ?? 0;

        // 2. TAXA DE CONVERSÃO DE ONBOARDING
        // (Membros Ativos / (Membros Ativos + Todos os status de pendência))
        $activeMembersCount = User::comPerfil('Membro')->where('association_id', $associationId)->where('status', 'active')->count();
        $totalOnboardingUsers = $activeMembersCount + $docsPendingUploadCount + $docsUnderReviewCount + $paymentPendingCount;
        $onboardingConversionRate = ($totalOnboardingUsers > 0) ? ($activeMembersCount / $totalOnboardingUsers) * 100 : 0;

        // 3. MEMBROS ATIVOS VS INATIVOS
        $inactiveMembersCount = User::comPerfil('Membro')->where('association_id', $associationId)->where('status', 'inactive')->count();

        // 4. DADOS PARA GRÁFICO DE RECEITA MENSAL (ÚLTIMOS 12 MESES)
        $monthlyRevenue = Sale::where('association_id', $associationId)
            ->where('status', 'paid')
            ->where('created_at', '>=', now()->subMonths(11))
            ->select(
                DB::raw('SUM(total_price) as total'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('total', 'month')
            ->all();

        // 5. DADOS PARA GRÁFICO DE NOVOS MEMBROS (ÚLTIMOS 12 MESES)
        $newMembersByMonth = User::comPerfil('Membro')
            ->where('association_id', $associationId)
            ->where('created_at', '>=', now()->subMonths(11))
            ->select(
                DB::raw('COUNT(id) as count'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('count', 'month')
            ->all();

        // Preencher meses sem dados para os gráficos
        $revenueChartData = [];
        $membersChartData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $monthLabel = now()->subMonths($i)->format('M/y');
            
            $revenueChartData['labels'][] = $monthLabel;
            $revenueChartData['data'][] = $monthlyRevenue[$month] ?? 0;

            $membersChartData['labels'][] = $monthLabel;
            $membersChartData['data'][] = $newMembersByMonth[$month] ?? 0;
        }

        return view('associacao.dashboard.index', compact(
            'totalUsers', 'totalMembers', 'totalClients',
            'docsPendingUploadCount', 'docsUnderReviewCount', 'paymentPendingCount',
            'totalRevenue', 'pendingRevenue', 'activePlans', 'totalPlans',
            'publishedNews', 'draftNews', 'recentSales',
            // Novos dados para a view
            'averageTicket',
            'onboardingConversionRate',
            'activeMembersCount',
            'inactiveMembersCount',
            'revenueChartData',
            'membersChartData',
            'gamificationData',
            'layout',
            'userLayoutConfig'
        ));
    }
}
