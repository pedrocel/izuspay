<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Domínio
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form action="{{ route('cliente.domains.update', $domain->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="domain" class="block text-gray-700 dark:text-gray-200">Domínio</label>
                    <input type="text" name="domain" id="domain" class="block w-full mt-1" value="{{ $domain->domain }}" required>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Atualizar</button>
            </form>
        </div>
    </div>
</x-app-layout>