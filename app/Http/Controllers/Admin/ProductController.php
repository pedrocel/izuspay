<?php

namespace App\Http\Controllers\associacao;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\StoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Exibir a lista de produtos
    public function index(Request $request)
    {
        $products = Product::query()
        ->when($request->category, function($query) use ($request) {
            return $query->where('category', $request->category);
        })
        ->when($request->search, function($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->when($request->store, function ($query) use ($request) {
            return $query->where('id_store', $request->store);
        })
        ->paginate(12); // Paginação com 12 produtos por página
        
        return view('associacao.products.index', compact('products', 'categories', 'stores')); // Redireciona para a view Blade 'index'
    }

    // Exibir o formulário de criação de produto
    public function create()
    {

        return view('associacao.products.create', compact('categories', 'stores')); // Retorna para a view de criação de produto
    }

    // Armazenar novo produto no banco de dados
    public function store(Request $request)
    {
        $price = str_replace(',', '.', $request->input('price'));
        $possible_profit = str_replace(',', '.', $request->input('possible_profit'));

        // Validação personalizada
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'sales_count' => 'nullable|integer',
            'is_trending' => 'nullable|boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
            'link' => 'nullable|url',
            'image_url' => 'nullable|url',
            'category' => 'nullable|integer',
            'status' => 'nullable|integer',
            'possible_profit' => 'nullable|numeric',
        ]);

        // Criação do produto
        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $price,
            'sales_count' => $request->input('sales_count'),
            'is_trending' => $request->input('is_trending', 0),  // Caso o campo não seja informado, 0 será o valor padrão
            'rating' => $request->input('rating'),
            'link' => $request->input('link'),
            'image_url' => $request->input('image_url'),
            'category' => $request->input('category'),
            'status' => $request->input('status', 1),  // Padrão como visível
            'possible_profit' => $possible_profit,
            'id' => Str::uuid(),  // Gerar ID UUID
        ]);
        return redirect()->route('associacao.products.index')->with('success', 'Produto criado com sucesso!'); // Redireciona de volta para a lista de produtos
    }

    // Exibir o formulário de edição do produto
    public function edit($id)
    {
        $product = ProductModel::where('id', $id)->first();
        $categories = CategoryModel::all(); // Pega todas as categorias da base de dados
        $stores = StoreModel::all(); // Obtém todas as lojas
        return view('associacao.products.edit', compact('product', 'categories', 'stores')); // Retorna para a view de edição do produto
    }

    // Atualizar as informações do produto no banco de dados
    public function update(Request $request, Product $product)
{
    $price = str_replace(',', '.', $request->input('price'));
    $possible_profit = str_replace(',', '.', $request->input('possible_profit'));

    $update = $product->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $price,
        'sales_count' => $request->input('sales_count'),
        'is_trending' => $request->input('is_trending', 0),  // Caso o campo não seja informado, 0 será o valor padrão
        'rating' => $request->input('rating'),
        'link' => $request->input('link'),
        'image_url' => $request->input('image_url'),
        'category' => $request->input('category'),
        'status' => $request->input('status', 1),  // Padrão como visível
        'possible_profit' => $possible_profit,
        'id_store' => $request->id_store,
    ]);

    return redirect()->route('associacao.products.index')->with('success', 'Produto atualizado com sucesso!'); // Redireciona de volta para a lista de produtos
}

    // Excluir um produto
    public function destroy(Product $product)
    {
        $product->delete(); // Deleta o produto do banco de dados
        return redirect()->route('associacao.products.index')->with('success', 'Produto excluído com sucesso!'); // Redireciona para a lista de produtos
    }
}
