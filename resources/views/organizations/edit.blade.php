<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Organização
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <form action="{{ route('admin.organizacoes.update', $organizacao) }}" method="POST" class="bg-white p-6 shadow rounded-lg">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Nome</label>
                <input type="text" name="name" id="name" class="border border-gray-300 rounded w-full px-4 py-2" value="{{ old('name', $organizacao->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Description</label>
                <input type="textarea" name="description" id="description" class="border border-gray-300 rounded w-full px-4 py-2" value="{{ old('description', $organizacao->description) }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Atualizar</button>
                <a href="{{ route('admin.perfis.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>