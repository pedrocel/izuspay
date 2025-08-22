<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Biblioteca de Produtos
        </h2>
    </x-slot>
    <div class="container mx-auto mt-6 px-4">
    <div class="mb-6">
            <!-- Botão para abrir o modal -->
            <!-- Botões lado a lado -->
                <div class="flex gap-4 mt-4">
                    <!-- Botão para abrir o modal -->
                    <button id="openModal" class="block px-4 py-2 text-gray-200 bg-gradient-to-r from-[#50a8f2] to-[#6affe2] text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">        
                        Filtrar produtos
                    </button>
 
                    <!-- Botão Produtos Favoritos com ícone e gradiente -->
                    <button id="favoriteProducts" class="flex items-center gap-2 bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.518 4.674a1 1 0 00.95.69h4.91c.969 0 1.371 1.24.588 1.81l-3.978 2.89a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.539 1.118l-3.978-2.89a1 1 0 00-1.176 0l-3.978 2.89c-.784.57-1.838-.196-1.539-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.476 9.1c-.783-.57-.381-1.81.588-1.81h4.91a1 1 0 00.95-.69l1.518-4.674z" />
                        </svg>
                        Produtos Favoritos(em breve)
                    </button>
                </div>

            <!-- Modal -->
            <div id="filterModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-gray-800 text-gray-200 rounded-lg shadow-lg p-6 w-full max-w-md">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Filtrar Produtos</h3>
                        <button id="closeModal" class="text-gray-400 hover:text-white focus:outline-none">
                            &times;
                        </button>
                    </div>

                    <!-- Formulário de Filtros -->
                    <form method="GET" action="{{ route('cliente.products.index') }}" class="flex flex-col gap-4">
                        <div>
                            <label for="category" class="block text-sm font-medium">Categoria</label>
                            <select id="category" name="category" class="mt-2 block w-full bg-gray-700 p-2 rounded focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Todas as Categorias</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="store" class="block text-sm font-medium">Loja</label>
                            <select id="store" name="store" class="mt-2 block w-full bg-gray-700 p-2 rounded focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Todas as Lojas</option>
                                @foreach($stores as $store)
                                    <option value="{{ $store->id }}" {{ request('store') == $store->id ? 'selected' : '' }}>
                                        {{ $store->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="search" class="block text-sm font-medium">Buscar</label>
                            <input type="text" id="search" name="search" placeholder="Buscar por nome" value="{{ request('search') }}" class="mt-2 block w-full bg-gray-700 p-2 rounded focus:ring-blue-500 focus:border-blue-500" />
                        </div>

                        <button type="submit" class="block px-4 py-2 text-gray-200 bg-gradient-to-r from-[#50a8f2] to-[#6affe2] text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                            Aplicar Filtros
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($products as $product)
        <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden hover:scale-105 transform transition duration-300">
            <a href="{{ route('cliente.products.detail', $product->id) }}">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 sm:h-64 object-cover cursor-pointer">
            </a>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-white">{{ $product->name }}</h3>
                <p class="text-gray-400 mt-2">
                    {{ Str::limit($product->description, 150, '...') }}
                </p>

                <div class="mt-4 flex justify-between items-center">
    @if($product->is_trending)
        <span class="flex items-center text-green-500 font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#f97316" viewBox="0 0 24 24" stroke="none" class="w-5 h-5 mr-1">
                <path d="M12 2C9.65 2 8.17 4.08 8.17 6.56c0 1.08.28 2.1.78 3.01C8.26 9.92 7 8.74 7 7.3 7 5.13 8.78 3 11 3c.37 0 .72.06 1.07.16.54-.95.94-1.7.94-1.7zM15.75 9.73c.4.62.75 1.39.75 2.25 0 3.38-3.21 5.42-3.87 5.85-.68-.43-3.87-2.47-3.87-5.85 0-.69.12-1.38.35-2.03.2.32.46.61.76.85C9.9 9.93 9 9.55 9 9c0-1.57 1.65-2.86 2.58-3.6.53-.42.87-.77 1.13-1.19.15.56.65 1.47 1.5 1.85.45.2.87.42 1.24.69-.26.5-.48 1.06-.7 1.66z" />
            </svg>
            Em Alta
        </span>
    @endif
    <div class="text-right ml-auto">
        <!-- Mostrar o preço -->
        <span class="text-lg font-semibold text-gray-300">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
        <br>
        <!-- Mostrar a possibilidade de lucro -->
        <span class="text-sm text-gray-400">
            Lucro: 
            R$ {{ number_format($product->possible_profit - $product->price, 2, ',', '.') }}
        </span>
    </div>
</div>


                <!-- Informações Adicionais -->
                <div class="mt-2 flex justify-between items-center">
                    <span class="text-sm text-gray-400">Vendas: {{ $product->sales_count }}</span>

                    <!-- Botão Ver Detalhes -->
                    <a href="{{ route('cliente.products.detail', $product->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Ver Detalhes
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>


        <!-- Paginação -->
        <div class="mt-6 text-gray-300">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
