<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100">
    {{-- Dashboard --}}
    <div class="p-6">
        {{-- 4 Cards Superiores --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @foreach (range(1, 4) as $index)
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <h3 class="text-xl font-bold">Card {{ $index }}</h3>
                    <p class="text-gray-600">Conteúdo</p>
                </div>
            @endforeach
        </div>

        {{-- Gráfico e Card --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
            {{-- Card com Gráfico (75%) --}}
            <div class="sm:col-span-3 bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4">Gráfico</h3>
                <div class="w-full h-64 bg-gradient-to-r from-[#D350F2] to-[#AB66FF] rounded-lg"></div>
            </div>

            {{-- Card à Direita (25%) --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4">Card Menor</h3>
                <p class="text-gray-600">Conteúdo</p>
            </div>
        </div>

        {{-- 4 Cards em Linha --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @foreach (range(1, 4) as $index)
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <h3 class="text-xl font-bold">Card {{ $index }}</h3>
                    <p class="text-gray-600">Conteúdo</p>
                </div>
            @endforeach
        </div>

        {{-- Tabela --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-xl font-bold mb-4">Tabela</h3>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="p-2">ID</th>
                        <th class="p-2">Nome</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Data</th>
                        <th class="p-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (range(1, 5) as $id)
                        <tr class="border-b">
                            <td class="p-2">{{ $id }}</td>
                            <td class="p-2">Nome {{ $id }}</td>
                            <td class="p-2">Ativo</td>
                            <td class="p-2">2024-12-16</td>
                            <td class="p-2">
                                <button class="text-blue-500">Detalhes</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
