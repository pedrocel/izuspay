

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nova Loja
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <form action="{{ route('admin.stores.store') }}" method="POST" class="bg-white p-6 shadow rounded-lg">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Nome</label>
                <input type="text" name="name" id="name" class="border border-gray-300 rounded w-full px-4 py-2" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="url_imagem" class="block text-gray-700 font-medium">Url da imagem</label>
                <input type="text" name="url_imagem" id="url_imagem" class="border border-gray-300 rounded w-full px-4 py-2" value="{{ old('url_imagem') }}" required>
                @error('url_imagem')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-create">Salvar</button>
                <a href="{{ route('admin.stores.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
