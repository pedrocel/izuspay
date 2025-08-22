<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest; // Use o Request
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Exibe a lista de produtos da associação.
     */
    public function index()
    {
        // Filtra os produtos para mostrar apenas os da associação do usuário logado
        $products = Product::where('association_id', auth()->user()->association_id)
                           ->paginate(10);
        return view('associacao.products.index', compact('products'));
    }

    /**
     * Exibe o formulário de criação de um novo produto.
     */
    public function create()
    {
        return view('associacao.products.create_edit');
    }

    /**
     * Salva um novo produto no banco de dados.
     */
    public function store(Request $request) // Use o ProductRequest
    {
        // Pega os dados validados do Request
        // Atribui o association_id do usuário logado antes de criar o produto
        $request['association_id'] = auth()->user()->association_id;
        
        Product::create($request->all());

        return redirect()->route('associacao.products.index')
                         ->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Exibe o formulário de edição de um produto.
     */
    public function edit(Product $product)
    {
        // Verificação de segurança: impede que um usuário edite o produto de outra associação
        if ($product->association_id !== auth()->user()->association_id) {
            abort(403, 'Acesso negado.');
        }

        return view('associacao.products.create_edit', compact('product'));
    }

    /**
     * Atualiza um produto no banco de dados.
     */
    public function update(Request $request, Product $product) // Use o ProductRequest
    {
        // Verificação de segurança
        if ($product->association_id !== auth()->user()->association_id) {
            abort(403, 'Acesso negado.');
        }
        
        $product->update($request->all());


        return redirect()->route('associacao.products.index')
                         ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Exclui um produto do banco de dados.
     */
    public function destroy(Product $product)
    {
        // Verificação de segurança
        if ($product->association_id !== auth()->user()->association_id) {
            abort(403, 'Acesso negado.');
        }
        
        $product->delete();

        return redirect()->route('associacao.products.index')
                         ->with('success', 'Produto excluído com sucesso!');
    }
}