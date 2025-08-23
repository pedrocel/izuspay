<?php

namespace App\Http\Controllers\associacao;

use App\Enums\CategoriaProduto;
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
        $products = Product::where('association_id', auth()->user()->association_id)
        ->paginate(12); // Paginação com 12 produtos por página
        
        return view('associacao.products.index', compact('products')); // Redireciona para a view Blade 'index'
    }

    // Exibir o formulário de criação de produto
    public function create()
    {
        $categorias = CategoriaProduto::all();

        return view('associacao.products.create_edit', compact('categorias')); // Retorna para a view de criação de produto
    }

   public function store(Request $request)
    {
        $price = str_replace(',', '.', $request->input('price'));

        $data = [
            'association_id' => auth()->user()->association_id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $price,
            'sales_count' => $request->input('sales_count'),
            'is_active' => $request->input('is_active', 1),
            'tipo_produto' => $request->input('tipo_produto'),
            'entrega_produto' => $request->input('entrega_produto'),
            'categoria_produto' => $request->input('categoria_produto'),
            'url_venda' => $request->input('url_venda'),
            'nome_sac' => $request->input('nome_sac'),
            'email_sac' => $request->input('email_sac'),
        ];

        // Upload da imagem, se houver
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('associacao.products.index')->with('success', 'Produto criado com sucesso!');
    }

    // Exibir o formulário de edição do produto
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        
        return view('associacao.products.create_edit', compact('product')); // Retorna para a view de edição do produto
    }

    // Atualizar as informações do produto no banco de dados
   public function update(Request $request, Product $product)
{
    $price = str_replace(',', '.', $request->input('price'));
    $possible_profit = str_replace(',', '.', $request->input('possible_profit'));

    $updateData = [
        'association_id' => auth()->user()->association_id,
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $price,
        'sales_count' => $request->input('sales_count'),
        'is_active' => $request->input('is_active', 1),
        'tipo_produto' => $request->input('tipo_produto'),
        'entrega_produto' => $request->input('entrega_produto'),
        'categoria_produto' => $request->input('categoria_produto'),
        'url_venda' => $request->input('url_venda'),
        'nome_sac' => $request->input('nome_sac'),
        'email_sac' => $request->input('email_sac'),
    ];

    // Upload da imagem, se houver
    if ($request->hasFile('image')) {
        // Deleta imagem antiga
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }
        $updateData['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($updateData);

    return redirect()->route('associacao.products.index')
                     ->with('success', 'Produto atualizado com sucesso!');
}

    // Excluir um produto
    public function destroy(Product $product)
    {
        $product->delete(); // Deleta o produto do banco de dados
        return redirect()->route('associacao.products.index')->with('success', 'Produto excluído com sucesso!'); // Redireciona para a lista de produtos
    }
}
