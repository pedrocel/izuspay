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
                    <!-- Status "Em Alta" -->
                    @if($product->is_trending)
                        <span class="text-green-500 font-bold">Em Alta</span>
                    @endif

                    <!-- Preço -->
                    <span class="text-2xl font-bold text-gray-800">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                </div>

                <!-- Quantidade de Vendas -->
                <p class="text-gray-600">Vendas: <span class="font-semibold">{{ $product->sales_count }}</span></p>

                <div class="mt-6 flex space-x-4 items-center">
                <a href="{{$product->link}}" target="_blank" class="btn-primary bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Acessar pagina do produto
                </a>
                <form action="{{ route('cliente.product.toggleFavorite', $product->id) }}" method="POST">
                    @csrf
                    @if($product->isFavoritedByUser(Auth::user()))
                        <button type="submit" class="btn-primary bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Remover dos favoritos</button>
                    @else
                        <button type="submit" class="btn-primary bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Adicionar aos favoritos</button>                
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
                <!-- Aqui você pode adicionar outras informações relevantes do produto -->
            </div>
        </div>
    </div>
</x-app-layout>
