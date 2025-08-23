@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- CABEÇALHO PRINCIPAL --}}
    <div class="bg-gradient-to-r from-purple-900 via-purple-800 to-black rounded-xl p-6 border border-purple-500/20 shadow-2xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i data-lucide="layout-dashboard" class="w-7 h-7 text-white"></i>
                    </div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">Lux Secrets Dashboard</h2>
                </div>
                <p class="text-purple-200">Controle total da sua plataforma de conteúdo exclusivo</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="#" class="inline-flex items-center space-x-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span>Novo Conteúdo</span>
                </a>
            </div>
        </div>
    </div>

    {{-- GRID PRINCIPAL DO DASHBOARD --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- PRIMEIRA LINHA - MÉTRICAS PRINCIPAIS --}}
        <div class="bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-purple-900/20 rounded-2xl p-6 border border-purple-200 dark:border-purple-500/30 hover:shadow-2xl hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-purple-600 dark:text-purple-400 mb-1">Total de Membros</p>
                    <p class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">{{ $totalMembers }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="user-square" class="w-7 h-7 text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-white to-green-50 dark:from-gray-800 dark:to-green-900/20 rounded-2xl p-6 border border-green-200 dark:border-green-500/30 hover:shadow-2xl hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-green-600 dark:text-green-400 mb-1">Receita Total</p>
                    <p class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="wallet" class="w-7 h-7 text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-blue-900/20 rounded-2xl p-6 border border-blue-200 dark:border-blue-500/30 hover:shadow-2xl hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400 mb-1">Ticket Médio</p>
                    <p class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">R$ {{ number_format($averageTicket, 2, ',', '.') }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="dollar-sign" class="w-7 h-7 text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-white to-orange-50 dark:from-gray-800 dark:to-orange-900/20 rounded-2xl p-6 border border-orange-200 dark:border-orange-500/30 hover:shadow-2xl hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-orange-600 dark:text-orange-400 mb-1">Pagamentos Pendentes</p>
                    <p class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-red-500 bg-clip-text text-transparent">R$ {{ number_format($pendingRevenue, 2, ',', '.') }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="credit-card" class="w-7 h-7 text-white"></i>
                </div>
            </div>
        </div>

        {{-- SEGUNDA LINHA - MÉTRICAS SECUNDÁRIAS --}}
        <div class="bg-gradient-to-br from-white to-emerald-50 dark:from-gray-800 dark:to-emerald-900/20 rounded-2xl p-6 border border-emerald-200 dark:border-emerald-500/30 hover:shadow-2xl hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400 mb-1">Membros Ativos</p>
                    <p class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent">{{ $activeMembersCount }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="user-check" class="w-7 h-7 text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-white to-red-50 dark:from-gray-800 dark:to-red-900/20 rounded-2xl p-6 border border-red-200 dark:border-red-500/30 hover:shadow-2xl hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-red-600 dark:text-red-400 mb-1">Membros Inativos</p>
                    <p class="text-3xl font-bold bg-gradient-to-r from-red-600 to-pink-500 bg-clip-text text-transparent">{{ $inactiveMembersCount }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="user-x" class="w-7 h-7 text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-white to-teal-50 dark:from-gray-800 dark:to-teal-900/20 rounded-2xl p-6 border border-teal-200 dark:border-teal-500/30 hover:shadow-2xl hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-teal-600 dark:text-teal-400 mb-1">Conversão de Onboarding</p>
                    <p class="text-3xl font-bold bg-gradient-to-r from-teal-600 to-green-500 bg-clip-text text-transparent">{{ number_format($onboardingConversionRate, 1, ',', '.') }}%</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="trending-up" class="w-7 h-7 text-white"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- JORNADA DO SUCESSO - CARD MAIOR --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="lg:col-span-2 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border border-purple-500/30 p-8 shadow-xl hover:shadow-2xl transition-all duration-300">
            {{-- Novo layout linear com barra de progresso no topo --}}
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">Jornada do Sucesso</h3>
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="seedling" class="w-8 h-8 text-white"></i>
                </div>
            </div>

            {{-- Layout horizontal com informações --}}
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-8">
                <div class="text-center md:text-left">
                    <p class="text-4xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent mb-2">Semente</p>
                    <p class="text-lg text-gray-300">Faturamento: R$ 6.000,00</p>
                </div>
                
                <div class="text-center md:text-right">
                    <p class="text-sm text-gray-400 mb-2">Progresso para próximo nível</p>
                    <div class="w-full max-w-md bg-gray-600 rounded-full h-3 mb-2 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full transition-all duration-1000 ease-out" style="width: 60%"></div>
                    </div>
                    <p class="text-3xl font-bold text-white mb-2">60.0%</p>
                    <p class="text-sm text-gray-400">Meta: R$ 10.000</p>
                </div>
            </div>
            
            {{-- Sistema de elos com 5 níveis inspirado no LoL --}}
            <div class="border-t border-gray-700 pt-6">
                <h4 class="text-lg font-semibold text-gray-300 mb-6 text-center">Elos de Faturamento</h4>
                <div class="flex justify-center items-end gap-8 mb-6">
                    {{-- Nível 1: Semente (R$ 10k) - 60% preenchido --}}
                    <div class="flex flex-col items-center group">
                        <div class="relative w-20 h-20 mb-3">
                            {{-- Fundo cinza (40%) --}}
                            <div class="absolute inset-0 rounded-full bg-gray-600"></div>
                            {{-- Preenchimento 60% --}}
                            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 opacity-60" style="clip-path: polygon(0 40%, 100% 40%, 100% 100%, 0 100%)"></div>
                            {{-- SVG do elo --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-12 h-12 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                                    <circle cx="12" cy="12" r="3" fill="currentColor"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-amber-400">SEMENTE</span>
                        <span class="text-xs text-gray-400">R$ 10k</span>
                    </div>

                    {{-- Nível 2: Bronze (R$ 100k) - Bloqueado --}}
                    <div class="flex flex-col items-center group">
                        <div class="relative w-20 h-20 mb-3">
                            <div class="absolute inset-0 rounded-full bg-gray-600"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L15.09 8.26L22 9L15.09 9.74L12 16L8.91 9.74L2 9L8.91 8.26L12 2Z"/>
                                    <path d="M12 6L13.5 10.5L18 12L13.5 13.5L12 18L10.5 13.5L6 12L10.5 10.5L12 6Z"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">BRONZE</span>
                        <span class="text-xs text-gray-400">R$ 100k</span>
                    </div>

                    {{-- Nível 3: Prata (R$ 500k) - Bloqueado --}}
                    <div class="flex flex-col items-center group">
                        <div class="relative w-20 h-20 mb-3">
                            <div class="absolute inset-0 rounded-full bg-gray-600"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L15.09 8.26L22 9L15.09 9.74L12 16L8.91 9.74L2 9L8.91 8.26L12 2Z"/>
                                    <path d="M12 4L14 9L19 10L14 11L12 15L9.5 11L5 10L9.5 9L12 4Z"/>
                                    <circle cx="12" cy="10" r="2"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">PRATA</span>
                        <span class="text-xs text-gray-400">R$ 500k</span>
                    </div>

                    {{-- Nível 4: Ouro (R$ 1M) - Bloqueado --}}
                    <div class="flex flex-col items-center group">
                        <div class="relative w-20 h-20 mb-3">
                            <div class="absolute inset-0 rounded-full bg-gray-600"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L15.09 8.26L22 9L15.09 9.74L12 16L8.91 9.74L2 9L8.91 8.26L12 2Z"/>
                                    <path d="M12 3L14.5 8.5L20 9L14.5 9.5L12 15L9.5 9.5L4 9L9.5 8.5L12 3Z"/>
                                    <path d="M12 5L13.5 9.5L18 10L13.5 10.5L12 15L10.5 10.5L6 10L10.5 9.5L12 5Z"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">OURO</span>
                        <span class="text-xs text-gray-400">R$ 1M</span>
                    </div>

                    {{-- Nível 5: Diamante (R$ 5M) - Bloqueado --}}
                    <div class="flex flex-col items-center group">
                        <div class="relative w-20 h-20 mb-3">
                            <div class="absolute inset-0 rounded-full bg-gray-600"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 3h12l4 6-10 12L2 9l4-6z"/>
                                    <path d="M6 3l4 6h4l4-6"/>
                                    <path d="M6 9l6 12 6-12"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">DIAMANTE</span>
                        <span class="text-xs text-gray-400">R$ 5M</span>
                    </div>
                </div>
                
                <p class="text-sm text-gray-400 text-center">
                    Alcance metas de faturamento para desbloquear novos elos e recompensas exclusivas
                </p>
            </div>
        </div>
    </div>

    {{-- TERCEIRA LINHA - ATIVIDADE RECENTE (LARGURA TOTAL) --}}
   {{-- TERCEIRA LINHA - ATIVIDADE RECENTE (LARGURA TOTAL) --}}
<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300">
    <div class="bg-gradient-to-r from-purple-600 to-pink-500 px-6 py-4">
        <h3 class="text-lg font-semibold text-white flex items-center gap-2">
            <i data-lucide="activity" class="w-5 h-5"></i>
            Atividade Recente
        </h3>
    </div>
    <div class="p-6">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($recentSales as $sale)
            <li class="py-4 hover:bg-purple-50 dark:hover:bg-purple-900/10 rounded-lg px-2 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                            {{-- Ícone diferente para planos vs produtos --}}
                            @if($sale->plan_id)
                                <i data-lucide="credit-card" class="w-6 h-6 text-white"></i>
                            @else
                                <i data-lucide="package" class="w-6 h-6 text-white"></i>
                            @endif
                        </div>
                        <div>
                            {{-- Verificar se é plano ou produto --}}
                            @if($sale->plan_id && $sale->plan)
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Venda do Plano: {{ $sale->plan->name }}</p>
                            @elseif($sale->product_id && $sale->product)
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Venda do Produto: {{ $sale->product->name }}</p>
                            @else
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Venda realizada</p>
                            @endif
                            <p class="text-xs text-gray-500 dark:text-gray-400">Cliente: {{ $sale->user->name }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">+ R$ {{ number_format($sale->total_price, 2, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $sale->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </li>
            @empty
            <li class="py-8 text-center text-gray-500 dark:text-gray-400">
                <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-2 opacity-50"></i>
                <p>Nenhuma venda recente.</p>
            </li>
            @endforelse
        </ul>
    </div>
</div>

</div>

<script>
    // Inicializa os ícones da página
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
@endsection
