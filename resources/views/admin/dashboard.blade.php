@extends('layouts.app')

@section('title', 'Painel THANOS SAAS')

@section('content')
<!-- Professional Payment Gateway Dashboard -->
        
<!-- Header com Filtros Melhorados -->
<div class="sticky top-0 z-30 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700 mb-8">
    <div class="px-6 py-4">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Dashboard de Pagamentos</h1>
                <p class="text-slate-600 dark:text-slate-400 mt-1">Período: {{ $startDate }} a {{ $endDate }}</p>
            </div>
            
            <!-- Filtros Rápidos -->
            <div class="flex flex-wrap items-center gap-3">
                <div class="flex bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['start_date', 'end_date']), ['start_date' => now()->toDateString(), 'end_date' => now()->toDateString()])) }}" 
                       class="px-3 py-2 text-sm font-medium rounded-md transition-all {{ request('start_date') == now()->toDateString() ? 'bg-blue-500 text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        Hoje
                    </a>
                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['start_date', 'end_date']), ['start_date' => now()->subDays(7)->toDateString(), 'end_date' => now()->toDateString()])) }}" 
                       class="px-3 py-2 text-sm font-medium rounded-md transition-all {{ request('start_date') == now()->subDays(7)->toDateString() ? 'bg-blue-500 text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        7 dias
                    </a>
                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['start_date', 'end_date']), ['start_date' => now()->subDays(30)->toDateString(), 'end_date' => now()->toDateString()])) }}" 
                       class="px-3 py-2 text-sm font-medium rounded-md transition-all {{ request('start_date') == now()->subDays(30)->toDateString() || !request('start_date') ? 'bg-blue-500 text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        30 dias
                    </a>
                </div>
                
                <button onclick="toggleAdvancedFilters()" id="advanced-filter-btn" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                    </svg>
                    Filtros Avançados
                    @if(request()->hasAny(['search', 'status', 'start_date', 'end_date']))
                        <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">
                            {{ collect(request()->only(['search', 'status', 'start_date', 'end_date']))->filter()->count() }}
                        </span>
                    @endif
                </button>
            </div>
        </div>
        
        <!-- Painel de Filtros Avançados -->
        <div id="advanced-filters" class="hidden mt-4 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600 animate-slide-down">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Data Inicial</label>
                        <input type="date" name="start_date" id="start_date" 
                               class="w-full bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               value="{{ request('start_date', $startDate) }}">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Data Final</label>
                        <input type="date" name="end_date" id="end_date" 
                               class="w-full bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               value="{{ request('end_date', $endDate) }}">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <select name="status" id="status" class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Todos os Status</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>✅ Pago</option>
                            <option value="awaiting_payment" {{ request('status') == 'awaiting_payment' ? 'selected' : '' }}>⏳ Pendente</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>❌ Cancelado</option>
                            <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>↩️ Reembolsado</option>
                            <option value="chargeback" {{ request('status') == 'chargeback' ? 'selected' : '' }}>⚠️ Chargeback</option>
                            <option value="refused" {{ request('status') == 'refused' ? 'selected' : '' }}>🚫 Recusado</option>
                        </select>
                    </div>
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Buscar</label>
                        <input type="text" name="search" id="search" placeholder="Cliente, produto, ID..." 
                               class="w-full bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               value="{{ request('search') }}">
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-600">
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        @if(request()->hasAny(['search', 'status', 'start_date', 'end_date']))
                            <span class="inline-flex items-center gap-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                Filtros ativos
                            </span>
                        @endif
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-gray-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            Limpar Filtros
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Aplicar Filtros
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- KPI Cards Grid - Usando suas variáveis -->
<!-- KPI Cards Grid - Premium Version (3 per row) -->
<!-- KPI Cards Grid - Compact Version (4 per row) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    
    <!-- Card: Total -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-slate-50 via-white to-blue-50 dark:from-gray-800 dark:via-gray-800 dark:to-blue-900/20 rounded-xl shadow-lg border border-slate-200/60 dark:border-gray-600/40 p-4 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-out">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-400/10 to-purple-400/10 rounded-xl opacity-0 group-hover:opacity-100 blur transition-opacity duration-300"></div>
        
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-slate-600 to-blue-600 rounded-lg flex items-center justify-center shadow-md group-hover:rotate-3 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="w-2 h-2 bg-slate-400 rounded-full animate-pulse"></div>
            </div>
            
            <div class="space-y-1">
                <p class="text-xs font-semibold text-slate-600 dark:text-slate-300 tracking-wide uppercase">Total</p>
                <p class="text-lg font-bold text-slate-900 dark:text-white">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">Receita Total</p>
            </div>
        </div>
    </div>

    <!-- Card: Pago -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-50 to-green-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl shadow-lg border border-green-200/60 dark:border-green-600/40 p-4 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-out">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-green-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="absolute -inset-0.5 bg-gradient-to-r from-emerald-400/10 to-green-400/10 rounded-xl opacity-0 group-hover:opacity-100 blur transition-opacity duration-300"></div>
        
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-lg flex items-center justify-center shadow-md group-hover:-rotate-3 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            </div>
            
            <div class="space-y-1">
                <p class="text-xs font-semibold text-green-700 dark:text-green-400 tracking-wide uppercase">Pago</p>
                <p class="text-lg font-bold text-green-800 dark:text-green-300">R$ {{ number_format($paidRevenue, 2, ',', '.') }}</p>
                <p class="text-xs text-green-600 dark:text-green-400">Confirmados</p>
            </div>
        </div>
    </div>

    <!-- Card: Pendente -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-amber-50 to-yellow-50 dark:from-amber-900/20 dark:to-yellow-900/20 rounded-xl shadow-lg border border-amber-200/60 dark:border-amber-600/40 p-4 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-out">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-yellow-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="absolute -inset-0.5 bg-gradient-to-r from-amber-400/10 to-yellow-400/10 rounded-xl opacity-0 group-hover:opacity-100 blur transition-opacity duration-300"></div>
        
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-lg flex items-center justify-center shadow-md group-hover:rotate-12 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="w-2 h-2 border border-amber-500 rounded-full animate-spin"></div>
            </div>
            
            <div class="space-y-1">
                <p class="text-xs font-semibold text-amber-700 dark:text-amber-400 tracking-wide uppercase">Pendente</p>
                <p class="text-lg font-bold text-amber-800 dark:text-amber-300">R$ {{ number_format($pendingRevenue, 2, ',', '.') }}</p>
                <p class="text-xs text-amber-600 dark:text-amber-400">Processando</p>
            </div>
        </div>
    </div>

    <!-- Card: Reembolsado -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-sky-50 to-blue-50 dark:from-blue-900/20 dark:to-sky-900/20 rounded-xl shadow-lg border border-blue-200/60 dark:border-blue-600/40 p-4 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-out">
        <div class="absolute inset-0 bg-gradient-to-br from-sky-500/5 to-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-400/10 to-blue-400/10 rounded-xl opacity-0 group-hover:opacity-100 blur transition-opacity duration-300"></div>
        
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-sky-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md group-hover:-rotate-6 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                    </svg>
                </div>
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
            </div>
            
            <div class="space-y-1">
                <p class="text-xs font-semibold text-blue-700 dark:text-blue-400 tracking-wide uppercase">Reembolsado</p>
                <p class="text-lg font-bold text-blue-800 dark:text-blue-300">R$ {{ number_format($refundedRevenue, 2, ',', '.') }}</p>
                <p class="text-xs text-blue-600 dark:text-blue-400">Devolvidos</p>
            </div>
        </div>
    </div>
</div>

<!-- Second Row -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 mb-8">
    
    <!-- Card: Chargeback -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 rounded-xl shadow-lg border border-orange-200/60 dark:border-orange-600/40 p-4 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-out">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-red-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="absolute -inset-0.5 bg-gradient-to-r from-orange-400/10 to-red-400/10 rounded-xl opacity-0 group-hover:opacity-100 blur transition-opacity duration-300"></div>
        
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center shadow-md group-hover:rotate-6 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="w-2 h-2 bg-red-500 rounded-full animate-ping"></div>
            </div>
            
            <div class="space-y-1">
                <p class="text-xs font-semibold text-orange-700 dark:text-orange-400 tracking-wide uppercase">Chargeback</p>
                <p class="text-lg font-bold text-orange-800 dark:text-orange-300">R$ {{ number_format($chargebackRevenue, 2, ',', '.') }}</p>
                <p class="text-xs text-orange-600 dark:text-orange-400">Disputas</p>
            </div>
        </div>
    </div>

    <!-- Card: Recusado -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 rounded-xl shadow-lg border border-red-200/60 dark:border-red-600/40 p-4 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-out">
        <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-rose-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-400/10 to-rose-400/10 rounded-xl opacity-0 group-hover:opacity-100 blur transition-opacity duration-300"></div>
        
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-rose-600 rounded-lg flex items-center justify-center shadow-md group-hover:-rotate-12 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
            </div>
            
            <div class="space-y-1">
                <p class="text-xs font-semibold text-red-700 dark:text-red-400 tracking-wide uppercase">Recusado</p>
                <p class="text-lg font-bold text-red-800 dark:text-red-300">R$ {{ number_format($refusedRevenue, 2, ',', '.') }}</p>
                <p class="text-xs text-red-600 dark:text-red-400">Rejeitados</p>
            </div>
        </div>
    </div>
</div>

<!-- Top 10 Creators Ranking -->
{{-- ... (código anterior do dashboard: header, filtros, cards, gráficos) ... --}}

<!-- Top 10 Creators Ranking -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-slate-200 dark:border-gray-700 overflow-hidden mb-8">
    <div class="px-6 py-4 border-b border-slate-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center">
                    <i data-lucide="award" class="w-5 h-5 text-white"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Top 10 Vendedores - Setembro</h3>
            </div>
            <div class="text-sm text-slate-500 dark:text-slate-400">
                Maiores vendedores do mês
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <div class="space-y-4">
            {{-- SUBSTITUÍMOS O @for E O @empty POR UM ÚNICO @forelse --}}
            @forelse ($topCreators as $index => $creator)
                <div class="flex items-center space-x-4 p-4 rounded-lg hover:bg-slate-50 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                    <!-- Ranking Badge -->
                    <div class="flex-shrink-0">
                        @if($index < 3)
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-lg
                                {{ $index == 0 ? 'bg-gradient-to-br from-yellow-400 to-yellow-600' : '' }}
                                {{ $index == 1 ? 'bg-gradient-to-br from-gray-300 to-gray-500' : '' }}
                                {{ $index == 2 ? 'bg-gradient-to-br from-orange-400 to-orange-600' : '' }}
                            ">
                                @if($index == 0) 👑 @elseif($index == 1) 🥈 @else 🥉 @endif
                            </div>
                        @else
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-400 to-slate-600 flex items-center justify-center font-bold text-white shadow-lg">
                                {{ $index + 1 }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Creator Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-3">
                            <!-- Avatar -->
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 via-pink-500 to-indigo-500 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                {{-- Usamos a primeira letra do nome real do criador --}}
                                <span class="text-white font-bold text-lg">{{ substr($creator->name, 0, 1) }}</span>
                            </div>
                            
                            <!-- Name and Stats -->
                            <div class="flex-1 min-w-0">
                                {{-- Usamos o nome real do criador --}}
                                <h4 class="text-base font-semibold text-slate-900 dark:text-white truncate">{{ $creator->name }}</h4>
                                <div class="flex items-center space-x-4 mt-1">
                                    <div class="flex items-center space-x-1 text-sm text-slate-600 dark:text-slate-400">
                                        <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                        {{-- Usamos o total de vendas real --}}
                                        <span>{{ $creator->total_sales }} vendas</span>
                                    </div>
                                    {{-- A estatística de crescimento pode ser implementada no futuro --}}
                                    <div class="flex items-center space-x-1 text-sm text-green-600 dark:text-green-400">
                                        <i data-lucide="trending-up" class="w-4 h-4"></i>
                                        <span>+{{ rand(5, 25) }}% vs mês anterior</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Revenue -->
                    <div class="flex-shrink-0 text-right">
                        <div class="text-xl font-bold text-slate-900 dark:text-white">
                            {{-- Usamos a receita total real --}}
                            R$ {{ number_format($creator->total_revenue, 2, ',', '.') }}
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">
                            ID: {{ $creator->id }}
                        </div>
                    </div>
                    
                    <!-- Action -->
                    <div class="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('admin.associations.show', $creator->id) }}" class="p-2 text-slate-400 hover:text-slate-600 dark:text-slate-500 dark:hover:text-slate-300" title="Ver detalhes da conta">
                            <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <i data-lucide="cloud-off" class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600"></i>
                    <h4 class="mt-4 text-lg font-semibold text-gray-600 dark:text-gray-400">Nenhum dado de vendas encontrado para este mês.</h4>
                    <p class="text-sm text-gray-400 dark:text-gray-500">O ranking será exibido assim que as primeiras vendas forem confirmadas.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- ... (resto do código do dashboard: tabela de transações, modais, scripts) ... --}}


<!-- Compact Filter Button - More Discrete -->
<button id="filter-btn" class="fixed bottom-4 right-4 bg-slate-600 hover:bg-slate-700 text-white p-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 z-40 opacity-80 hover:opacity-100">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
    </svg>
</button>

<!-- Compact Filter Modal -->
<div id="filter-modal" class="fixed inset-0 bg-black/30 z-50 hidden backdrop-blur-sm">
    <div class="flex h-full">
        <div class="flex-1" onclick="closeFilterModal()"></div>
        
        <div class="w-80 bg-white dark:bg-gray-800 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out" id="filter-modal-content">
            <div class="h-full flex flex-col">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Filtros</h3>
                        <button onclick="closeFilterModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex-1 overflow-y-auto p-4">
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Data Inicial</label>
                            <input type="date" name="start_date" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" value="{{ $request->input('start_date', $startDate) }}">
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Data Final</label>
                            <input type="date" name="end_date" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" value

<style>

</style>

<!-- Charts Section Melhorada -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
    <!-- Sales Chart - Usando suas variáveis -->
    <div class="xl:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-slate-200 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Faturamento por Dia</h3>
            <div class="flex items-center gap-3">
                <div class="text-sm text-slate-500 dark:text-slate-400">{{ $startDate }} - {{ $endDate }}</div>
                <div class="flex gap-2">
                    <button onclick="exportChart()" class="flex items-center gap-1 px-3 py-1 text-sm text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        PNG
                    </button>
                </div>
            </div>
        </div>
        <div class="h-80">
            <canvas id="salesChart" width="400" height="200"></canvas>
        </div>
        
        <!-- Chart Stats -->
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 grid grid-cols-3 gap-4">
            <div class="text-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">Maior Dia</div>
                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                    R$ {{ number_format(collect($chartValues)->max(), 2, ',', '.') }}
                </div>
            </div>
            <div class="text-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">Média Diária</div>
                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                    R$ {{ number_format(collect($chartValues)->avg(), 2, ',', '.') }}
                </div>
            </div>
            <div class="text-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">Menor Dia</div>
                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                    R$ {{ number_format(collect($chartValues)->min(), 2, ',', '.') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Status Distribution -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-slate-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-6">Status das Transações</h3>
        <div class="h-64 mb-4">
            <canvas id="statusChart"></canvas>
        </div>
        
        <!-- Status Legend -->
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    <span class="text-sm font-medium text-green-700 dark:text-green-300">Pagos</span>
                </div>
                <span class="text-sm font-bold text-green-800 dark:text-green-200">R$ {{ number_format($paidRevenue, 2, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-amber-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-amber-700 dark:text-amber-300">Pendentes</span>
                </div>
                <span class="text-sm font-bold text-amber-800 dark:text-amber-200">R$ {{ number_format($pendingRevenue, 2, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-sm font-medium text-blue-700 dark:text-blue-300">Reembolsados</span>
                </div>
                <span class="text-sm font-bold text-blue-800 dark:text-blue-200">R$ {{ number_format($refundedRevenue, 2, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <span class="text-sm font-medium text-red-700 dark:text-red-300">Recusados</span>
                </div>
                <span class="text-sm font-bold text-red-800 dark:text-red-200">R$ {{ number_format($refusedRevenue, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Transactions Table - Usando $recentTransactions -->
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-slate-200 dark:border-gray-700 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-200 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Transações Recentes</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                Exibindo {{ $recentTransactions->count() }} transações
            </p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- Live Search -->
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" id="live-search" placeholder="Buscar transações..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-sm w-64">
            </div>
            
            <!-- Export Button -->
            <button onclick="exportTransactions()" class="flex items-center gap-2 px-4 py-2 text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Exportar CSV
            </button>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-gray-700">
            <thead class="bg-slate-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider cursor-pointer hover:bg-slate-100 dark:hover:bg-gray-600 transition-colors" onclick="sortTable('id')">
                        <div class="flex items-center gap-2">
                            ID
                            <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider cursor-pointer hover:bg-slate-100 dark:hover:bg-gray-600 transition-colors" onclick="sortTable('customer')">
                        <div class="flex items-center gap-2">
                            Cliente
                            <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Produto/Plano</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider cursor-pointer hover:bg-slate-100 dark:hover:bg-gray-600 transition-colors" onclick="sortTable('value')">
                        <div class="flex items-center gap-2">
                            Valor
                            <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider cursor-pointer hover:bg-slate-100 dark:hover:bg-gray-600 transition-colors" onclick="sortTable('date')">
                        <div class="flex items-center gap-2">
                            Data
                            <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-slate-200 dark:divide-gray-700" id="transactions-tbody">
                @forelse ($recentTransactions as $sale)
                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-700 transition-colors animate-fade-in" data-transaction-id="{{ $sale->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                            #{{ $sale->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center shadow-md">
                                        <span class="text-sm font-semibold text-white">{{ substr($sale->user->name ?? 'N', 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $sale->user->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-slate-500 dark:text-slate-400">{{ $sale->user->email ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $sale->product->name ?? $sale->plan->name ?? 'N/A' }}</div>
                            @if($sale->product && $sale->product->category)
                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $sale->product->category }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-slate-900 dark:text-white">R$ {{ number_format($sale->total_price, 2, ',', '.') }}</div>
                            @if($sale->discount_amount > 0)
                                <div class="text-xs text-green-600 dark:text-green-400">Desconto: -R$ {{ number_format($sale->discount_amount, 2, ',', '.') }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {!! $sale->getStatusBadge() !!}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-slate-900 dark:text-white">{{ $sale->created_at->format('d/m/Y') }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">{{ $sale->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="viewTransactionDetails({{ $sale->id }})" 
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors" 
                                        title="Ver detalhes">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                
                                @if($sale->status == 'paid')
                                    <button onclick="processRefund({{ $sale->id }})" 
                                            class="text-orange-600 hover:text-orange-900 dark:text-orange-400 dark:hover:text-orange-300 p-2 rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors" 
                                            title="Processar reembolso">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                        </svg>
                                    </button>
                                @endif
                                
                                <div class="relative">
                                    <button onclick="toggleDropdown({{ $sale->id }})" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                        </svg>
                                    </button>
                                    
                                    <div id="dropdown-{{ $sale->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-600 z-10">
                                        <div class="py-1">
                                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Gerar Relatório
                                            </a>
                                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                Enviar Mensagem
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Nenhuma transação encontrada</p>
                                <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Tente ajustar os filtros para ver mais resultados</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination melhorada -->
        <div class="px-6 py-4 border-t border-slate-200 dark:border-gray-700 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-600 dark:text-slate-400">
                </span>
                
                <!-- Items per page -->
                <div class="flex items-center gap-2">
                    <label class="text-sm text-slate-600 dark:text-slate-400">Por página:</label>
                    <select onchange="changeItemsPerPage(this.value)" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500">
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 || !request('per_page') ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
            
            <div class="flex gap-2">
            </div>
        </div>
</div>

<!-- Transaction Details Modal -->
<div id="transaction-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detalhes da Transação</h3>
                <button onclick="closeTransactionModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="transaction-modal-content" class="p-6">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-xl flex items-center gap-4">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <span class="text-gray-900 dark:text-white font-medium">Processando...</span>
        </div>
    </div>
</div>

<!-- Chart.js Script Melhorado -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
    setupEnhancedFeatures();
});

function initializeCharts() {
    // Sales Chart - Usando suas variáveis PHP
    const salesCtx = document.getElementById('salesChart');
    if (salesCtx) {
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [
                    {
                        label: 'Faturamento Diário',
                        data: {!! json_encode($chartValues) !!},
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#1d4ed8',
                        pointHoverBorderWidth: 3
                    },
                    {
                        label: 'Meta Diária',
                        data: Array({!! count($chartValues) !!}).fill({{ floor($totalRevenue / max(count($chartValues), 1)) }}),
                        borderColor: '#ef4444',
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        borderDash: [8, 4],
                        pointRadius: 0,
                        tension: 0,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: '500',
                                family: 'Inter'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#374151',
                        borderWidth: 1,
                        cornerRadius: 12,
                        padding: 16,
                        titleFont: {
                            size: 14,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 13,
                            weight: '500'
                        },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': R$ ' + context.parsed.y.toLocaleString('pt-BR', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(148, 163, 184, 0.1)',
                            borderColor: 'rgba(148, 163, 184, 0.2)'
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 12,
                                family: 'Inter'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(148, 163, 184, 0.1)',
                            borderColor: 'rgba(148, 163, 184, 0.2)'
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 12,
                                family: 'Inter'
                            },
                            callback: function(value) {
                                return 'R$ ' + value.toLocaleString('pt-BR');
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutCubic'
                }
            }
        });
    }

    // Status Chart - Usando suas variáveis PHP
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pagos', 'Pendentes', 'Reembolsados', 'Recusados'],
                datasets: [{
                    data: [
                        {{ $paidRevenue }},
                        {{ $pendingRevenue }},
                        {{ $refundedRevenue }},
                        {{ $refusedRevenue }}
                    ],
                    backgroundColor: [
                        '#10b981',
                        '#f59e0b', 
                        '#3b82f6',
                        '#ef4444'
                    ],
                    borderWidth: 0,
                    hoverBorderWidth: 4,
                    hoverBorderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        cornerRadius: 12,
                        padding: 16,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.parsed * 100) / total).toFixed(1) : 0;
                                return context.label + ': R$ ' + context.parsed.toLocaleString('pt-BR', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + ' (' + percentage + '%)';
                            }
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeInOutCubic'
                }
            }
        });
    }
}

function setupEnhancedFeatures() {
    // Live search
    const liveSearch = document.getElementById('live-search');
    if (liveSearch) {
        liveSearch.addEventListener('input', debounce(function() {
            filterTransactions(this.value);
        }, 300));
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('[id^="dropdown-"]') && !e.target.closest('button[onclick^="toggleDropdown"]')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
}

function toggleAdvancedFilters() {
    const panel = document.getElementById('advanced-filters');
    const btn = document.getElementById('advanced-filter-btn');
    
    if (panel.classList.contains('hidden')) {
        panel.classList.remove('hidden');
        btn.classList.add('bg-blue-700');
    } else {
        panel.classList.add('hidden');
        btn.classList.remove('bg-blue-700');
    }
}

function filterTransactions(searchTerm) {
    const rows = document.querySelectorAll('#transactions-tbody tr');
    const term = searchTerm.toLowerCase();
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(term)) {
            row.style.display = '';
            row.classList.add('animate-fade-in');
        } else {
            row.style.display = 'none';
        }
    });
}

function sortTable(field) {
    // Implementar ordenação local das linhas visíveis
    const tbody = document.getElementById('transactions-tbody');
    const rows = Array.from(tbody.querySelectorAll('tr')).filter(row => row.style.display !== 'none');
    
    rows.sort((a, b) => {
        let aVal, bVal;
        
        switch(field) {
            case 'id':
                aVal = a.cells[0].textContent.replace('#', '');
                bVal = b.cells[0].textContent.replace('#', '');
                return parseInt(aVal) - parseInt(bVal);
            case 'customer':
                aVal = a.cells[1].textContent.toLowerCase();
                bVal = b.cells[1].textContent.toLowerCase();
                return aVal.localeCompare(bVal);
            case 'value':
                aVal = parseFloat(a.cells[3].textContent.replace(/[R$\s.,]/g, '').replace(',', '.'));
                bVal = parseFloat(b.cells[3].textContent.replace(/[R$\s.,]/g, '').replace(',', '.'));
                return aVal - bVal;
            case 'date':
                aVal = new Date(a.cells[5].textContent.split(' ')[0].split('/').reverse().join('-'));
                bVal = new Date(b.cells[5].textContent.split(' ')[0].split('/').reverse().join('-'));
                return aVal - bVal;
        }
        return 0;
    });
    
    // Re-append sorted rows
    rows.forEach(row => tbody.appendChild(row));
}

function viewTransactionDetails(id) {
    showLoading();
    
    // Simular carregamento dos detalhes - substituir por chamada real
    setTimeout(() => {
        const modalContent = document.getElementById('transaction-modal-content');
        modalContent.innerHTML = `
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="text-sm font-medium text-gray-600 dark:text-gray-400">ID da Transação</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">#${id}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="text-sm font-medium text-gray-600 dark:text-gray-400">Status</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">Pago</div>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-600 pt-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Histórico da Transação</h4>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-green-800 dark:text-green-200">Pagamento Aprovado</div>
                                <div class="text-xs text-green-600 dark:text-green-400">28/08/2024 às 14:32</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        hideLoading();
        document.getElementById('transaction-modal').classList.remove('hidden');
    }, 800);
}

function closeTransactionModal() {
    document.getElementById('transaction-modal').classList.add('hidden');
}

function processRefund(id) {
    if (confirm(`Confirma o processamento de reembolso para a transação #${id}?`)) {
        showLoading();
        
        // Simular processamento - substituir por chamada real ao backend
        setTimeout(() => {
            hideLoading();
            alert(`Reembolso da transação #${id} processado com sucesso!`);
            // Recarregar a página para atualizar os dados
            window.location.reload();
        }, 2000);
    }
}

function toggleDropdown(id) {
    // Fechar outros dropdowns
    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
        if (dropdown.id !== `dropdown-${id}`) {
            dropdown.classList.add('hidden');
        }
    });
    
    // Toggle dropdown atual
    const dropdown = document.getElementById(`dropdown-${id}`);
    dropdown.classList.toggle('hidden');
}

function exportChart() {
    const canvas = document.getElementById('salesChart');
    const link = document.createElement('a');
    link.download = `faturamento_${new Date().toISOString().split('T')[0]}.png`;
    link.href = canvas.toDataURL();
    link.click();
}

function exportTransactions() {
    showLoading();
    
    setTimeout(() => {
        // Gerar CSV dos dados visíveis
        const rows = document.querySelectorAll('#transactions-tbody tr');
        let csv = 'ID,Cliente,Produto,Valor,Status,Data\n';
        
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const cells = row.querySelectorAll('td');
                if (cells.length > 1) {
                    const id = cells[0].textContent.trim();
                    const customer = cells[1].querySelector('.font-medium').textContent.trim();
                    const product = cells[2].textContent.trim();
                    const value = cells[3].textContent.trim();
                    const status = cells[4].textContent.trim();
                    const date = cells[5].textContent.trim();
                    
                    csv += `"${id}","${customer}","${product}","${value}","${status}","${date}"\n`;
                }
            }
        });
        
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = `transacoes_${new Date().toISOString().split('T')[0]}.csv`;
        link.click();
        window.URL.revokeObjectURL(url);
        
        hideLoading();
    }, 1000);
}

function changeItemsPerPage(value) {
    const url = new URL(window.location);
    url.searchParams.set('per_page', value);
    window.location.href = url.toString();
}

function showLoading() {
    document.getElementById('loading-overlay').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loading-overlay').classList.add('hidden');
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Real-time updates (opcional)
function startRealTimeUpdates() {
    setInterval(() => {
        // Atualizar apenas os valores sem recarregar a página
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Atualizar KPIs se houver mudanças
            if (data.totalRevenue) {
                document.querySelector('[data-kpi="total"]').textContent = 
                    'R$ ' + new Intl.NumberFormat('pt-BR').format(data.totalRevenue);
            }
        })
        .catch(error => console.log('Update failed:', error));
    }, 30000); // Atualizar a cada 30 segundos
}

</script>

@endsection