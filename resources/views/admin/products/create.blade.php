<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cadastrar Novo Produto
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-medium">Cadastrar Produto</h2>
            <a href="{{ route('admin.products.index') }}" class="text-blue-500 hover:underline">
                Voltar para a lista de produtos
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nome do Produto</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Descrição do Produto</label>
                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Preço</label>
                    <input type="text" id="price" name="price" value="{{ old('price') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('price')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="sales_count" class="block text-gray-700">Quantidade de Vendas</label>
                    <input type="number" id="sales_count" name="sales_count" value="{{ old('sales_count') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('sales_count')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="is_trending" class="block text-gray-700">Produto em Alta?</label>
                    <select id="is_trending" name="is_trending" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="1" {{ old('is_trending') == '1' ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ old('is_trending') == '0' ? 'selected' : '' }}>Não</option>
                    </select>
                    @error('is_trending')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="rating" class="block text-gray-700">Avaliação do Produto</label>
                    <input type="number" id="rating" name="rating" value="{{ old('rating') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" step="0.1" min="0" max="5">
                    @error('rating')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="link" class="block text-gray-700">Link do Produto</label>
                    <input type="url" id="link" name="link" value="{{ old('link') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('link')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image_url" class="block text-gray-700">URL da Imagem</label>
                    <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('image_url')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-gray-700">Categoria</label>
                    <select id="category" name="category" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="id_store" class="block text-gray-700">Loja</label>
                    <select id="id_store" name="id_store" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($stores as $store)
                            <option value="{{ $store->id }}" {{ old('id_store') == $store->id ? 'selected' : '' }}>{{ $store->name }}</option>
                        @endforeach
                    </select>
                    @error('id_store')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inativo</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="possible_profit" class="block text-gray-700">Lucro possível</label>
                    <input type="text" id="possible_profit" name="possible_profit" value="{{ old('possible_profit') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('possible_profit')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn-create bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Cadastrar Produto
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
