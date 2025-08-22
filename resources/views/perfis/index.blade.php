<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Perfis
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-medium">Gerenciamento de Perfis</h2>
            <a href="{{ route('admin.perfis.create') }}" class="btn-create">
  Cadastrar Novo Perfil
</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
            <thead class="table-blue-degrade">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">ID</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Nome</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perfis as $perfil)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $perfil->id }}</td>
                        <td class="px-4 py-2">{{ $perfil->name }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.perfis.edit', $perfil) }}" class="text-blue-500 hover:underline">Editar</a>
                            <form action="{{ route('admin.perfis.destroy', $perfil) }}" method="POST" class="inline-block">
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
                        <td colspan="3" class="text-center py-4 text-gray-500">Nenhum perfil cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
