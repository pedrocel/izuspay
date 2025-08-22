<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-lg leading-tight">
        Lista de Organizações
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-4 md:space-y-0 md:space-x-4">
            <h2 class="text-lg font-medium">Gerenciamento de Organizações</h2>
            <a href="{{ route('admin.organizacoes.create') }}" class="btn-create">
                Criar Organização
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full rounded-lg shadow overflow-hidden" style="box-shadow: 0 1px 3px 0 rgb(175 100 253), 0 1px 2px -1px rgb(208 82 244);">
            <thead class="table-blue-degrade">
                <tr>
                    <th class="px-4 py-2 text-left text-white font-medium">ID</th>
                    <th class="px-4 py-2 text-left text-white font-medium">Nome</th>
                    <th class="px-4 py-2 text-left text-white font-medium">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($organizacoes as $organizacao)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $organizacao->id }}</td>
                        <td class="px-4 py-2">{{ $organizacao->name }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.organizacoes.edit', $organizacao) }}" class="text-blue-500 hover:underline">Editar</a>
                            <form action="{{ route('admin.organizacoes.destroy', $organizacao) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Deseja excluir?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">Nenhuma organização cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>


