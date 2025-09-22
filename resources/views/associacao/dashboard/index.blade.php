@extends('layouts.app')

@section('title', 'Dashboard - Izus Payment')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    /* Efeitos de brilho e flutuação com a nova paleta AZUL */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    @keyframes glow-pulse-blue {
        0%, 100% { box-shadow: 0 0 25px rgba(59, 130, 246, 0.2), 0 0 40px rgba(30, 64, 175, 0.1); }
        50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.4), 0 0 60px rgba(30, 64, 175, 0.3); }
    }

    .card-hover-effect {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    .card-hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
    }
    .icon-float:hover {
        animation: float 3s ease-in-out infinite;
    }

    /* Scrollbar customizada para o tema azul */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #1e40af; border-radius: 3px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #3b82f6; }
</style>
@endpush

@section('content')
<div class="space-y-8">
    {{-- CABEÇALHO PRINCIPAL - IZUS PAYMENT --}}
    <div class="relative rounded-2xl p-8 overflow-hidden bg-slate-900 border border-blue-500/20 shadow-2xl">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-black to-black opacity-80"></div>
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-gradient-to-br from-blue-700 to-sky-500 rounded-full opacity-10 blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-4 mb-2">
                    <div class="w-16 h-16 bg-black/30 backdrop-blur-sm border border-white/10 rounded-xl flex items-center justify-center shadow-lg icon-float">
                        <i data-lucide="zap" class="w-8 h-8 text-blue-300 animate-pulse"></i>
                    </div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                        Izus Payment
                    </h1>
                </div>
                <p class="text-blue-200/80 ml-20 md:ml-0">Sua plataforma de pagamentos, simples e poderosa.</p>
            </div>
        </div>
    </div>

    {{-- GRID DE MÉTRICAS PRINCIPAIS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $metrics = [
                // ['title' => 'Total de Clientes', 'value' => $totalMembers, 'icon' => 'users-round', 'color' => 'blue-cyan'],
                ['title' => 'Receita Total', 'value' => 'R$ ' . number_format($totalRevenue, 2, ',', '.'), 'icon' => 'wallet-cards', 'color' => 'green-emerald'],
                ['title' => 'Ticket Médio', 'value' => 'R$ ' . number_format($averageTicket, 2, ',', '.'), 'icon' => 'dollar-sign', 'color' => 'sky-teal'],
                ['title' => 'Pagamentos Pendentes', 'value' => 'R$ ' . number_format($pendingRevenue, 2, ',', '.'), 'icon' => 'hourglass', 'color' => 'orange-amber'],
                // ['title' => 'Clientes Ativos', 'value' => $activeMembersCount, 'icon' => 'user-check', 'color' => 'emerald-teal'],
                // ['title' => 'Clientes Inativos', 'value' => $inactiveMembersCount, 'icon' => 'user-x', 'color' => 'red-rose'],
                ['title' => 'Conversão', 'value' => number_format($onboardingConversionRate, 1, ',', '.') . '%', 'icon' => 'trending-up', 'color' => 'teal-green'],
            ];
            $colors = [
                'blue-cyan' => ['from' => 'from-blue-500', 'to' => 'to-cyan-500', 'text' => 'text-blue-300'],
                'green-emerald' => ['from' => 'from-green-500', 'to' => 'to-emerald-500', 'text' => 'text-green-400'],
                'sky-teal' => ['from' => 'from-sky-500', 'to' => 'to-teal-500', 'text' => 'text-sky-300'],
                'orange-amber' => ['from' => 'from-orange-500', 'to' => 'to-amber-500', 'text' => 'text-orange-400'],
                'emerald-teal' => ['from' => 'from-emerald-500', 'to' => 'to-teal-500', 'text' => 'text-emerald-400'],
                'red-rose' => ['from' => 'from-red-500', 'to' => 'to-rose-500', 'text' => 'text-red-400'],
                'teal-green' => ['from' => 'from-teal-500', 'to' => 'to-green-500', 'text' => 'text-teal-400'],
            ];
        @endphp

        @foreach($metrics as $metric)
        <div class="relative bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl p-6 card-hover-effect overflow-hidden">
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br {{ $colors[$metric['color']]['from'] }} {{ $colors[$metric['color']]['to'] }} opacity-10 blur-2xl"></div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-1x1 font-medium {{ $colors[$metric['color']]['text'] }} mb-1">{{ $metric['title'] }}</p>
                    <p class="text-2xl font-bold text-white">{{ $metric['value'] }}</p>
                </div>
                <div class="w-14 h-14 bg-black/20 border border-white/10 rounded-2xl flex items-center justify-center shadow-lg icon-float">
                    <i data-lucide="{{ $metric['icon'] }}" class="w-7 h-7 {{ $colors[$metric['color']]['text'] }}"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- JORNADA DE CRESCIMENTO E ATIVIDADE RECENTE --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- JORNADA DE CRESCIMENTO --}}
        <div class="lg:col-span-2 relative bg-slate-900/70 backdrop-blur-xl border border-blue-500/30 rounded-2xl p-8 shadow-2xl overflow-hidden" style="animation: glow-pulse-blue 4s infinite ease-in-out;">
            <div class="absolute inset-0 bg-[url('/img/grid.svg')] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))] opacity-5"></div>
            <div class="absolute -top-1/4 -right-1/4 w-1/2 h-1/2 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-full opacity-20 blur-3xl"></div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-300 to-cyan-400 bg-clip-text text-transparent">Jornada de Crescimento</h3>
                    <div class="w-16 h-16 bg-black/30 border border-white/10 rounded-2xl flex items-center justify-center shadow-lg icon-float">
                        <i data-lucide="{{ $gamificationData['levelBadge'] }}" class="w-8 h-8 text-blue-300"></i>
                    </div>
                </div>

                <div class="bg-black/20 border border-white/10 rounded-xl p-6 mb-8 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-center md:text-left">
                        <p class="text-4xl font-bold bg-gradient-to-r from-blue-300 to-cyan-400 bg-clip-text text-transparent mb-1">{{ $gamificationData['levelName'] }}</p>
                        <p class="text-lg text-gray-300">Faturamento: R$ {{ number_format($gamificationData['currentRevenue'], 2, ',', '.') }}</p>
                    </div>
                    <div class="w-full md:w-auto text-center md:text-right">
                        <p class="text-sm text-gray-400 mb-2">Progresso para o próximo nível</p>
                        <div class="w-full bg-gray-700 rounded-full h-3 mb-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full transition-all duration-1000 ease-out" style="width: {{ $gamificationData['progressPercentage'] }}%"></div>
                        </div>
                        <p class="text-sm text-gray-400">Meta: <span class="font-bold text-white">R$ {{ number_format($gamificationData['nextLevelTarget'], 0, ',', '.') }}</span></p>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold text-gray-300 mb-6 text-center">Níveis de Faturamento</h4>
                    <div class="flex justify-between items-end gap-2 md:gap-4">
                        @foreach($gamificationData['allLevels'] as $index => $level)
                            <div class="flex flex-col items-center group flex-1 text-center">
                                <div class="relative w-16 h-16 md:w-20 md:h-20 mb-3 transition-transform duration-300 group-hover:scale-110">
                                    @if($index < $gamificationData['currentLevel'])
                                        <div class="absolute inset-0 rounded-full bg-gradient-to-br {{ $level['color'] }} opacity-80 shadow-lg" style="box-shadow: 0 0 15px {{ $level['shadowColor'] ?? 'rgba(59, 130, 246, 0.5)' }};"></div>
                                    @elseif($index == $gamificationData['currentLevel'])
                                        <div class="absolute inset-0 rounded-full bg-gray-700"></div>
                                        <div class="absolute inset-0 rounded-full bg-gradient-to-br {{ $level['color'] }} opacity-70" style="clip-path: polygon(0 {{ 100 - $gamificationData['progressPercentage'] }}%, 100% {{ 100 - $gamificationData['progressPercentage'] }}%, 100% 100%, 0 100%)"></div>
                                    @else
                                        <div class="absolute inset-0 rounded-full bg-gray-800 border-2 border-dashed border-gray-700"></div>
                                    @endif
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i data-lucide="{{ $level['badge'] }}" class="w-8 h-8 md:w-10 md:h-10 {{ $index <= $gamificationData['currentLevel'] ? $level['textColor'] ?? 'text-white' : 'text-gray-600' }}"></i>
                                    </div>
                                </div>
                                <span class="text-xs font-semibold {{ $index <= $gamificationData['currentLevel'] ? $level['textColor'] ?? 'text-white' : 'text-gray-600' }}">{{ strtoupper($level['name']) }}</span>
                                <span class="text-xs text-gray-500">R${{ number_format($level['min']/1000, 0) }}k</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ATIVIDADE RECENTE --}}
        <div class="lg:col-span-1 bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl shadow-xl card-hover-effect">
            <div class="p-6 border-b border-white/10">
                <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                    <i data-lucide="activity" class="w-5 h-5 text-blue-300"></i>
                    Atividade Recente
                </h3>
            </div>
            <div class="p-4 max-h-[480px] overflow-y-auto custom-scrollbar">
                <ul role="list" class="divide-y divide-white/10">
                    @forelse($recentSales as $sale)
                    <li class="py-4 px-2 hover:bg-blue-900/20 rounded-lg transition-colors duration-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-black/20 border border-white/10 rounded-lg flex items-center justify-center">
                                    <i data-lucide="{{ $sale->plan_id ? 'credit-card' : 'package' }}" class="w-5 h-5 text-gray-300"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-100">
                                        @if($sale->plan_id && $sale->plan) Venda: {{ $sale->plan->name }}
                                        @elseif($sale->product_id && $sale->product) Venda: {{ $sale->product->name }}
                                        @else Venda Realizada @endif
                                    </p>
                                    <p class="text-xs text-gray-400">Cliente: {{ Str::limit($sale->user->name, 15) }}</p>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0 ml-2">
                                <p class="text-sm font-bold text-green-400">+ R$ {{ number_format($sale->total_price, 2, ',', '.') }}</p>
                                <p class="text-xs text-gray-500">{{ $sale->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="py-8 text-center text-gray-500">
                        <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-2 opacity-50"></i>
                        <p>Nenhuma venda recente.</p>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
@endsection
