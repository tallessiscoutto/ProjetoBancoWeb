<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('fornecedor')->get();
        $fornecedores = Fornecedor::all();
        return view('Produtos.cadastro', compact('produtos', 'fornecedores'));
    }

    public function visualizar(Request $request)
    {
        $busca = $request->input('q');
        $query = Produto::with('fornecedor');
        if ($busca) {
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('descricao', 'like', "%{$busca}%")
                  ->orWhere('id', $busca);
            });
        }
        $produtos = $query->orderBy('nome')->paginate(10)->withQueryString();
        return view('Produtos.visualizar', compact('produtos', 'busca'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'localizacao' => 'nullable|string|max:255',
            'fornecedor_id' => 'required|exists:fornecedores,id'
        ]);

        $dados = $request->only(['nome','marca','descricao','preco','localizacao','quantidade','fornecedor_id']);
        if ($request->hasFile('foto')) {
            $caminho = $request->file('foto')->store('produtos', 'public');
            $dados['foto'] = $caminho;
        }

        Produto::create($dados);

        return redirect()->route('Produtos.cadastro')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $fornecedores = Fornecedor::all();
        return view('Produtos.editar', compact('produto', 'fornecedores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'localizacao' => 'nullable|string|max:255',
            'fornecedor_id' => 'required|exists:fornecedores,id'
        ]);

        $produto = Produto::findOrFail($id);

        $dados = $request->only(['nome','marca','descricao','preco','localizacao','quantidade','fornecedor_id']);
        if ($request->hasFile('foto')) {
            $caminho = $request->file('foto')->store('produtos', 'public');
            $dados['foto'] = $caminho;
        }

        $produto->update($dados);

        return redirect()->route('Produtos.cadastro')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('Produtos.cadastro')
            ->with('success', 'Produto excluído com sucesso!');
    }
    // em app/Http/Controllers/ProdutosController.php


    public function cadastrarLocalizacao(Request $request)
    {
        $busca = $request->input('busca');
    
        // Query base
        $query = Produto::query();
    
        // Se o usuário buscou algo, ordena para que o resultado venha no topo
        if ($busca) {
            $query->orderByRaw("
                CASE
                    WHEN nome LIKE ? THEN 0
                    WHEN id = ? THEN 1
                    ELSE 2
                END
            ", ["%{$busca}%", $busca]);
        }
    
        // Carrega todos os produtos (ordenados)
        $produtos = $query->orderBy('nome')->paginate(10)->withQueryString();
    
        return view('localizacao.index', compact('produtos', 'busca'));
    }
    public function busca(Request $request)
    {   // em app/Http/Controllers/ProdutosController.php
     $busca = $request->input('busca');

     $produtos = Produto::where('nome', 'like', "%{$busca}%")
        ->orWhere('id', $busca)
        ->get();

    return view('locacao.index', compact('produtos', 'busca'));
    }

} 