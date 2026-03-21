<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class RF_B01Controller extends Controller
{
    //
    public function CadastrarProduto()
    {
        $categorias = Categoria::all();
        $Produtos = Produto::all();
        $categoriaSelecionada = Categoria::where('nome', 'Perfumes')->first();
        if (!$categoriaSelecionada) {
            $categoriaSelecionada = Categoria::firstOrCreate(['nome' => 'Perfumes']);
        }

        return view('Produtos.cadastro', compact('categorias', 'Produtos', 'categoriaSelecionada'));
    }
    public function SalvarProduto(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $categoria = Categoria::firstOrCreate(['nome' => 'Perfumes']);


        $produto = new Produto();
        $produto->id = $request->id;
        $produto->nome = $request->nome;
        $produto->marca = $request->marca;
        $produto->preco = $request->preco;
        $produto->quantidade = $request->quantidade;
        $produto->categoria_id = $categoria->id;
        $produto->save();
        return redirect()->route('Produtos.cadastro');
    }

    public function EditarProduto($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();

        return view('Produtos.editar', compact('produto', 'categorias'));
    }

    public function AtualizarProduto(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $produto = Produto::findOrFail($id);
        $produto->update([
            'nome' => $request->nome,
            'marca' => $request->marca,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('Produtos.cadastro')->with('success', 'Produto atualizado com sucesso!');
    }


    public function ListarProdutos()
    {
        $Produtos = Produto::all();
        return view('Produtos.cadastro', ['Produtos' => $Produtos]);
    }
}