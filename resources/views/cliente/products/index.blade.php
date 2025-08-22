<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Biblioteca de Produtos
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-lg font-medium">Produtos</h2>
            
            <form method="GET" action="{{ route('cliente.products.index') }}" class="flex space-x-4">
                <!-- Filtros -->
                <div class="relative">
                    <select id="category" name="category" class="mt-1 block w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Todas as Categorias</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Barra de Busca -->
                <div class="relative">
                    <input type="text" id="search" name="search" placeholder="Buscar por nome" value="{{ request('search') }}" class="p-2 w-48 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Botão de Filtro -->
                <button type="submit" class="btn-filter bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Filtrar
                </button>
            </form>

        </div>

        <!-- Listagem de Produtos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Imagem do Produto -->
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">

                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $product->name }}</h3>
                        <p class="text-gray-600 mt-2">{{ $product->description }}</p>

                        <div class="mt-4 flex justify-between items-center">
                            <!-- Status "Em Alta" -->
                            @if($product->is_trending)
                                <span class="text-green-500 font-bold">Em Alta</span>
                            @endif

                            <!-- Preço -->
                            <span class="text-lg font-semibold text-gray-800">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                        </div>

                        <div class="mt-2 flex justify-between items-center">
                            <!-- Quantidade de Vendas -->
                            <span class="text-sm text-gray-600">Vendas: {{ $product->sales_count }}</span>

                            <!-- Link para Detalhes -->
                            <a href="{{ route('cliente.products.detail', $product->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginação -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
