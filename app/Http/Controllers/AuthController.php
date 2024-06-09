<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    public function index()
    {
        return Produto::all();
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'custo' => 'required|decimal',
            'preco' => 'required|decimal',
            'quantidade' => 'required|integer',
        ]);

        $produto = Produto::create($validated);
        return response()->json($produto, 201);
    }

    public function createMultiple(Request $request)
    {
        $validated = $request->validate([
            'produto' => 'required|array',
            'produto.*.nome' => 'required|string|max:255',
            'produto.*.custo' => 'required|decimal',
            'produto.*.preco' => 'required|decimal',
            'produto.*.quantidade' => 'required|integer',
        ]);

        $produto = Produto::insert($validated['produto']);
        return response()->json($produto, 201);
    }

    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'custo' => 'sometimes|required|decimal',
            'preco' => 'sometimes|required|decimal',
            'quantidade' => 'sometimes|required|integer',
        ]);

        $produto->update($validated);
        return response()->json($produto);
    }

    public function updateMultiple(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.nome' => 'sometimes|required|string|max:255',
            'products.*.custo' => 'sometimes|required|string',
            'products.*.preco' => 'sometimes|required|numeric',
            'products.*.quantidade' => 'sometimes|required|integer',
        ]);

        $updatedProduto = [];
        foreach ($validated['produto'] as $produtoData) {
            $produto = Produto::findOrFail($produtoData['id']);
            $produto->update($produtoData);
            $updatedProduto[] = $produto;
        }

        return response()->json($updatedProduto);
    }

    public function delete(Produto $produto)
    {
        $produto->delete();
        return response()->json(null, 204);
    }

    public function deleteMultiple(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:produto,id',
        ]);

        Produto::destroy($validated['ids']);
        return response()->json(null, 204);
    }
}

}
