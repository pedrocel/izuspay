<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Plan;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
            'gamificationLevel' => ['visible' => true, 'size' => 'col-span-1 lg:col-span-2'], // Increased size for better rewards display
            'rewardsHistory' => ['visible' => true, 'size' => 'col-span-1 lg:col-span-2'], // Added rewards history card
        ];

        // Mescla o layout do usuário com o padrão para garantir que novos cards apareçam
        $layout = $userLayout ? array_merge($defaultLayout, $userLayout) : $defaultLayout;

        $userLayoutConfig = auth()->user()->dashboardSetting->layout ?? [];
        // Reordena os cards com base na ordem salva pelo usuário, se existir
        if ($userLayout) {
            $layout = array_replace(array_flip(array_keys($userLayout)), $layout);
        }

        $totalRevenue = Sale::where('association_id', $associationId)->where('status', 'paid')->sum('total_price');
        $totalSales = Sale::where('association_id', $associationId)->where('status', 'paid')->count();
        $totalMembers = User::where('association_id', $associationId)->count();

        // Enhanced levels with more rewards and achievements
        $userGender = $this->detectGender(auth()->user());

        // Definindo níveis de sedutor baseado no gênero
        if ($userGender === 'male') {
            $levels = [
                1 => ['min' => 0, 'max' => 10000, 'name' => 'Aprendiz do Jogo', 'badge' => 'target', 'color' => 'green', 'rewards' => ['Dashboard básico'], 'description' => 'Primeiros passos na conquista.'],
                2 => ['min' => 10000, 'max' => 100000, 'name' => 'Encantador', 'badge' => 'rose', 'color' => 'amber', 'rewards' => ['Relatórios mensais'], 'description' => 'Começando a ser notado.'],
                3 => ['min' => 100000, 'max' => 500000, 'name' => 'Conquistador', 'badge' => 'heart', 'color' => 'gray', 'rewards' => ['Analytics avançado'], 'description' => 'Dominando a arte da atração.'],
                4 => ['min' => 500000, 'max' => 1000000, 'name' => 'Sedutor Implacável', 'badge' => 'fire', 'color' => 'yellow', 'rewards' => ['API personalizada'], 'description' => 'Irresistível e influente.'],
                5 => ['min' => 1000000, 'max' => 5000000, 'name' => 'Mestre da Paixão', 'badge' => 'crown', 'color' => 'blue', 'rewards' => ['Consultoria exclusiva'], 'description' => 'Elite da sedução.'],
                6 => ['min' => 5000000, 'max' => PHP_INT_MAX, 'name' => 'Lenda da Sedução', 'badge' => 'diamond', 'color' => 'purple', 'rewards' => ['Parceria estratégica'], 'description' => 'Top do topo.'],
            ];
        } elseif ($userGender === 'female') {
            $levels = [
                1 => ['min' => 0, 'max' => 10000, 'name' => 'Aprendiz do Charme', 'badge' => 'sparkles', 'color' => 'green', 'rewards' => ['Dashboard básico'], 'description' => 'Primeiros passos no charme.'],
                2 => ['min' => 10000, 'max' => 100000, 'name' => 'Encantadora', 'badge' => 'flower', 'color' => 'amber', 'rewards' => ['Relatórios mensais'], 'description' => 'Começando a brilhar.'],
                3 => ['min' => 100000, 'max' => 500000, 'name' => 'Diva Irresistível', 'badge' => 'dancer', 'color' => 'gray', 'rewards' => ['Analytics avançado'], 'description' => 'Atração máxima.'],
                4 => ['min' => 500000, 'max' => 1000000, 'name' => 'Deusa da Sedução', 'badge' => 'fire', 'color' => 'yellow', 'rewards' => ['API personalizada'], 'description' => 'Intensidade e poder.'],
                5 => ['min' => 1000000, 'max' => 5000000, 'name' => 'Rainha da Paixão', 'badge' => 'crown', 'color' => 'blue', 'rewards' => ['Consultoria exclusiva'], 'description' => 'Status lendário.'],
                6 => ['min' => 5000000, 'max' => PHP_INT_MAX, 'name' => 'Lenda do Desejo', 'badge' => 'diamond', 'color' => 'purple', 'rewards' => ['Parceria estratégica'], 'description' => 'Top do topo.'],
            ];
        } else {
            // Fallback unissex
            $levels = [
                1 => ['min' => 0, 'max' => 10000, 'name' => 'Iniciante', 'badge' => 'seedling', 'color' => 'green', 'rewards' => ['Dashboard básico'], 'description' => 'Começando a jornada.'],
                2 => ['min' => 10000, 'max' => 100000, 'name' => 'Intermediário', 'badge' => 'medal', 'color' => 'amber', 'rewards' => ['Relatórios mensais'], 'description' => 'Subindo de nível.'],
                3 => ['min' => 100000, 'max' => 500000, 'name' => 'Avançado', 'badge' => 'star', 'color' => 'gray', 'rewards' => ['Analytics avançado'], 'description' => 'Crescimento consistente.'],
                4 => ['min' => 500000, 'max' => 1000000, 'name' => 'Expert', 'badge' => 'trophy', 'color' => 'yellow', 'rewards' => ['API personalizada'], 'description' => 'Excelência reconhecida.'],
                5 => ['min' => 1000000, 'max' => 5000000, 'name' => 'Master', 'badge' => 'platinum-trophy', 'color' => 'blue', 'rewards' => ['Consultoria exclusiva'], 'description' => 'Elite do mercado.'],
                6 => ['min' => 5000000, 'max' => PHP_INT_MAX, 'name' => 'Lendário', 'badge' => 'diamond', 'color' => 'purple', 'rewards' => ['Parceria estratégica'], 'description' => 'Top do topo.'],
            ];
        }

        $currentLevelInfo = null;
        $currentLevel = 1;
        foreach ($levels as $level => $info) {
            if ($totalRevenue >= $info['min']) {
                $currentLevelInfo = $info;
                $currentLevelInfo['level'] = $level;
                $currentLevel = $level;
            } else {
                break;
            }
        }

        // Calculate progress to next level
        $nextLevel = $currentLevel + 1;
        $nextLevelMin = $levels[$nextLevel]['min'] ?? $currentLevelInfo['max'];
        $currentLevelMin = $currentLevelInfo['min'];

        $range = $nextLevelMin - $currentLevelMin;
        $progress = $totalRevenue - $currentLevelMin;
        $progressPercentage = ($range > 0) ? min(100, ($progress / $range) * 100) : 100;

        $gamificationData = [
            'levelName' => $currentLevelInfo['name'],
            'levelBadge' => $currentLevelInfo['badge'],
            'levelColor' => $currentLevelInfo['color'],
            'levelDescription' => $currentLevelInfo['description'],
            'currentLevel' => $currentLevel,
            'currentRevenue' => $totalRevenue,
            'nextLevelTarget' => $nextLevelMin,
            'progressPercentage' => $progressPercentage,
            'remainingToNext' => max(0, $nextLevelMin - $totalRevenue),
            'rewards' => $currentLevelInfo['rewards'],
            'nextLevelRewards' => $levels[$nextLevel]['rewards'] ?? [],
            'nextLevelName' => $levels[$nextLevel]['name'] ?? 'Máximo',
            'allLevels' => $levels,
            'achievements' => $this->calculateAchievements($totalRevenue, $totalSales, $totalMembers),
            'milestones' => $this->calculateMilestones($totalRevenue, $totalSales, $totalMembers),
        ];

        // === MÉTRICAS DE USUÁRIOS E PERFIS (EXISTENTES) ===
        $totalUsers = User::where('association_id', $associationId)->count();
        $totalMembers = User::where('association_id', $associationId)->count();
        $totalClients = User::where('association_id', $associationId)->count();

        // === MÉTRICAS DO FUNIL DE ONBOARDING (EXISTENTES) ===
        $docsPendingUploadCount = User::where('association_id', $associationId)->where('status', 'documentation_pending')->count();
        $docsUnderReviewCount = User::where('association_id', $associationId)->where('status', 'docs_under_review')->count();
        $paymentPendingCount = User::where('association_id', $associationId)->where('status', 'payment_pending')->count();
        
        // === MÉTRICAS DE VENDAS (EXISTENTES) ===
        $pendingRevenue = Sale::where('association_id', $associationId)->where('status', 'awaiting_payment')->sum('total_price');
        $activePlans = Plan::where('association_id', $associationId)->where('is_active', true)->count();
        $totalPlans = Plan::where('association_id', $associationId)->count();

        // === MÉTRICAS DE CONTEÚDO (EXISTENTES) ===
        $publishedNews = News::where('association_id', $associationId)->published()->count();
        $draftNews = News::where('association_id', $associationId)->draft()->count();

        // === ATIVIDADE RECENTE (EXISTENTE) ===
        $recentSales = Sale::where('association_id', $associationId)
                           ->with(['user', 'plan', 'product'])
                           ->latest()
                           ->take(5)
                           ->get();
        
        // 1. TICKET MÉDIO POR VENDA
        $averageTicket = Sale::where('association_id', $associationId)
                               ->where('status', 'paid')
                               ->avg('total_price') ?? 0;

        // 2. TAXA DE CONVERSÃO DE ONBOARDING
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

        $user = Auth::user();
        $association = $user->association;
        $creatorProfile = $user->creatorProfile;

        return view('associacao.dashboard.index', compact(
            'totalUsers', 'totalMembers', 'totalClients',
            'docsPendingUploadCount', 'docsUnderReviewCount', 'paymentPendingCount',
            'totalRevenue', 'pendingRevenue', 'activePlans', 'totalPlans',
            'publishedNews', 'draftNews', 'recentSales',
            'averageTicket',
            'onboardingConversionRate',
            'activeMembersCount',
            'inactiveMembersCount',
            'revenueChartData',
            'membersChartData',
            'gamificationData',
            'layout',
            'userLayoutConfig',
            'association',
            'creatorProfile'
        ));
    }

    private function calculateAchievements($revenue, $sales, $members)
    {
        $achievements = [];

        // Revenue-based achievements
        if ($revenue >= 10000) $achievements[] = ['name' => 'Primeira Receita', 'icon' => 'dollar-sign', 'unlocked' => true];
        if ($revenue >= 100000) $achievements[] = ['name' => 'Seis Dígitos', 'icon' => 'trending-up', 'unlocked' => true];
        if ($revenue >= 1000000) $achievements[] = ['name' => 'Milionário', 'icon' => 'crown', 'unlocked' => true];

        // Sales-based achievements
        if ($sales >= 10) $achievements[] = ['name' => 'Vendedor Iniciante', 'icon' => 'shopping-cart', 'unlocked' => true];
        if ($sales >= 100) $achievements[] = ['name' => 'Vendedor Expert', 'icon' => 'award', 'unlocked' => true];
        if ($sales >= 1000) $achievements[] = ['name' => 'Máquina de Vendas', 'icon' => 'zap', 'unlocked' => true];

        // Member-based achievements
        if ($members >= 50) $achievements[] = ['name' => 'Comunidade Ativa', 'icon' => 'users', 'unlocked' => true];
        if ($members >= 500) $achievements[] = ['name' => 'Grande Comunidade', 'icon' => 'globe', 'unlocked' => true];

        return $achievements;
    }

    private function calculateMilestones($revenue, $sales, $members)
    {
        $milestones = [];

        // Next revenue milestones
        $revenueMilestones = [25000, 50000, 250000, 750000, 2500000, 10000000];
        foreach ($revenueMilestones as $milestone) {
            if ($revenue < $milestone) {
                $milestones[] = [
                    'type' => 'revenue',
                    'target' => $milestone,
                    'current' => $revenue,
                    'progress' => ($revenue / $milestone) * 100,
                    'description' => 'Receita de R$ ' . number_format($milestone, 0, ',', '.')
                ];
                break; // Only show next milestone
            }
        }

        // Next sales milestones
        $salesMilestones = [25, 50, 250, 500, 1500];
        foreach ($salesMilestones as $milestone) {
            if ($sales < $milestone) {
                $milestones[] = [
                    'type' => 'sales',
                    'target' => $milestone,
                    'current' => $sales,
                    'progress' => ($sales / $milestone) * 100,
                    'description' => $milestone . ' vendas realizadas'
                ];
                break;
            }
        }

        // Next member milestones
        $memberMilestones = [25, 100, 250, 750, 1500];
        foreach ($memberMilestones as $milestone) {
            if ($members < $milestone) {
                $milestones[] = [
                    'type' => 'members',
                    'target' => $milestone,
                    'current' => $members,
                    'progress' => ($members / $milestone) * 100,
                    'description' => $milestone . ' membros ativos'
                ];
                break;
            }
        }

        return $milestones;
    }

    function detectGender($fullName) {
        $firstName = explode(' ', trim($fullName))[0];

        // Chamada para a API Genderize.io
        $response = Http::get('https://api.genderize.io', [
            'name' => $firstName
        ]);

        if ($response->ok()) {
            return $response->json()['gender'] ?? 'unknown'; // male, female ou unknown
        }

    return 'unknown';
}
}
