<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="lg:col-span-2 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border border-purple-500/30 p-8 shadow-xl hover:shadow-2xl transition-all duration-300">
        {{-- Fixed header to use correct levelBadge key --}}
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">Jornada do Sucesso</h3>
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                <span class="text-2xl">{{ $gamificationData['levelBadge'] }}</span>
            </div>
        </div>

        {{-- Fixed level info to use correct keys from controller --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-8">
            <div class="text-center md:text-left">
                <p class="text-4xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent mb-2">{{ $gamificationData['levelName'] }}</p>
                <p class="text-lg text-gray-300">Faturamento: R$ {{ number_format($gamificationData['currentRevenue'], 2, ',', '.') }}</p>
            </div>
            
            <div class="text-center md:text-right">
                <p class="text-sm text-gray-400 mb-2">Progresso para próximo nível</p>
                <div class="w-full max-w-md bg-gray-600 rounded-full h-3 mb-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full transition-all duration-1000 ease-out" style="width: {{ $gamificationData['progressPercentage'] }}%"></div>
                </div>
                <p class="text-3xl font-bold text-white mb-2">{{ number_format($gamificationData['progressPercentage'], 1) }}%</p>
                @if($gamificationData['nextLevelTarget'])
                    <p class="text-sm text-gray-400">Meta: R$ {{ number_format($gamificationData['nextLevelTarget'], 0, ',', '.') }}</p>
                @else
                    <p class="text-sm text-gray-400">Nível máximo atingido!</p>
                @endif
            </div>
        </div>
        
        {{-- Fixed levels loop to use allLevels array --}}
        <div class="border-t border-gray-700 pt-6">
            <h4 class="text-lg font-semibold text-gray-300 mb-6 text-center">Elos de Faturamento</h4>
            <div class="flex justify-center items-end gap-8 mb-6">
                @foreach($gamificationData['allLevels'] as $levelKey => $level)
                    <div class="flex flex-col items-center group">
                        <div class="relative w-20 h-20 mb-3">
                            {{-- Fixed level status check using currentRevenue --}}
                            @if($gamificationData['currentRevenue'] >= $level['min'])
                                {{-- Nível conquistado --}}
                                <div class="absolute inset-0 rounded-full bg-gradient-to-br from-{{ $level['color'] }}-400 to-{{ $level['color'] }}-600"></div>
                            @elseif($levelKey == $gamificationData['currentLevel'])
                                {{-- Nível atual em progresso --}}
                                <div class="absolute inset-0 rounded-full bg-gray-600"></div>
                                <div class="absolute inset-0 rounded-full bg-gradient-to-br from-{{ $level['color'] }}-400 to-{{ $level['color'] }}-600 opacity-60" style="clip-path: polygon(0 {{ 100 - $gamificationData['progressPercentage'] }}%, 100% {{ 100 - $gamificationData['progressPercentage'] }}%, 100% 100%, 0 100%)"></div>
                            @else
                                {{-- Nível bloqueado --}}
                                <div class="absolute inset-0 rounded-full bg-gray-600"></div>
                            @endif
                            
                            {{-- Fixed icon to use badge from level data --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-2xl">{{ $level['badge'] }}</span>
                            </div>
                        </div>
                        <span class="text-xs font-semibold {{ $gamificationData['currentRevenue'] >= $level['min'] ? 'text-'.$level['color'].'-400' : 'text-gray-500' }}">{{ strtoupper($level['name']) }}</span>
                        <span class="text-xs text-gray-400">R$ {{ $level['min'] >= 1000000 ? number_format($level['min']/1000000, 0).'M' : ($level['min'] >= 1000 ? number_format($level['min']/1000, 0).'k' : number_format($level['min'], 0)) }}</span>
                    </div>
                @endforeach
            </div>
            
            <p class="text-sm text-gray-400 text-center">
                Alcance metas de faturamento para desbloquear novos elos e recompensas exclusivas
            </p>
        </div>
    </div>
</div>
