<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Criar Novo Usuário
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="border border-gray-300 rounded px-3 py-2 w-full" 
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="border border-gray-300 rounded px-3 py-2 w-full" 
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="border border-gray-300 rounded px-3 py-2 w-full" 
                        required
                    >
                </div>

                <!-- Campo para selecionar o perfil -->
                <div class="mb-4">
                    <label for="perfil_id" class="block text-sm font-medium text-gray-700">Perfil</label>
                    <select 
                        name="perfil_id" 
                        id="perfil_id" 
                        class="border border-gray-300 rounded px-3 py-2 w-full" 
                        required
                    >
                        <option value="">Selecione um perfil</option>
                        @foreach($perfis as $perfil)
                            <option value="{{ $perfil->id }}">{{ $perfil->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Criar Usuário
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
