<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalhes do Produto
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <!-- Detalhes do Produto -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Imagem do Produto -->
            <div class="flex justify-center">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full max-w-md h-auto object-cover rounded-lg shadow-md">
            </div>

            <!-- Informações do Produto -->
            <div class="space-y-4">
                <h1 class="text-3xl font-semibold text-gray-900">{{ $product->name }}</h1>
                <p class="text-gray-600 text-lg">{{ $product->description }}</p>

                <div class="flex items-center space-x-4">
                    <!-- Status "Em Alta" com ícone -->
                    @if($product->is_trending)
                        <span class="flex items-center text-green-500 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#f97316" viewBox="0 0 24 24" stroke="none" class="w-5 h-5 mr-1">
                                <path d="M12 2C9.65 2 8.17 4.08 8.17 6.56c0 1.08.28 2.1.78 3.01C8.26 9.92 7 8.74 7 7.3 7 5.13 8.78 3 11 3c.37 0 .72.06 1.07.16.54-.95.94-1.7.94-1.7zM15.75 9.73c.4.62.75 1.39.75 2.25 0 3.38-3.21 5.42-3.87 5.85-.68-.43-3.87-2.47-3.87-5.85 0-.69.12-1.38.35-2.03.2.32.46.61.76.85C9.9 9.93 9 9.55 9 9c0-1.57 1.65-2.86 2.58-3.6.53-.42.87-.77 1.13-1.19.15.56.65 1.47 1.5 1.85.45.2.87.42 1.24.69-.26.5-.48 1.06-.7 1.66z" />
                            </svg>
                            Em Alta
                        </span>
                    @endif

                    <!-- Preço -->
                    <span class="text-2xl font-bold text-gray-800">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                </div>

                <!-- Possibilidade de Lucro -->
                <p class="text-gray-600">
                    Possibilidade de Lucro: 
                    <span class="font-semibold text-green-600">
                        R$ {{ number_format($product->possible_profit - $product->price, 2, ',', '.') }}
                    </span>
                </p>

                <!-- Quantidade de Vendas -->
                <p class="text-gray-600">Vendas: <span class="font-semibold">{{ $product->sales_count }}</span></p>

                <!-- Exibe a Imagem da Loja -->
                <div class="flex items-center space-x-4 mt-4">
                    <p class="text-gray-600 font-semibold">Loja:</p>
                    @if($product->id_store == 3)
                        <img src="https://logodownload.org/wp-content/uploads/2019/09/magalu-logo.png" alt="Logo Magalu" class="h-8">
                    @elseif($product->id_store == 1)
                        <img src="https://logodownload.org/wp-content/uploads/2021/03/shopee-logo.png" alt="Logo Shopee" class="h-8">
                    @elseif($product->id_store == 4)
                        <img src="https://logodownload.org/wp-content/uploads/2014/04/amazon-logo.png" alt="Logo Amazon" class="h-8">
                    @elseif($product->id_store == 2)
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Shein-logo.png/1200px-Shein-logo.png" alt="Logo Shein" class="h-8">
                    @else
                        <p class="text-gray-600"></p>
                    @endif
                </div>

                <!-- Ações -->
                <div class="mt-6 flex space-x-4 items-center">
                    <a href="{{ $product->link }}" target="_blank" class="btn-primary bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Acessar página do produto
                    </a>
                    <form action="{{ route('product.toggleFavorite', $product->id) }}" method="POST">
                        @csrf
                        @if($product->isFavoritedByUser(Auth::user()))
                            <button type="submit" class="btn-primary bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                Remover dos favoritos
                            </button>
                        @else
                            <button type="submit" class="btn-primary bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                Adicionar aos favoritos
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Informações Adicionais -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800">Informações Adicionais</h2>
            <div class="mt-4 p-4 bg-gray-50 rounded-lg shadow-sm">
                <p class="text-gray-600"><strong>Categoria:</strong> {{ $product->categoryR->name }}</p>
                <p class="text-gray-600"><strong>Data de Criação:</strong> {{ $product->created_at->format('d/m/Y') }}</p>
                <p class="text-gray-600"><strong>Última Atualização:</strong> {{ $product->updated_at->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
