<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\Funcionario;

class RF_F02Controller extends Controller
{
    public function cadastrarVenda(Request $request)
    {
        $produtoSelecionado = null;
        $funcionarios = Funcionario::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'produto_id' => 'required|exists:Produtos,id',
            ]);
            $produtoSelecionado = Produto::with('fornecedor')->find($request->produto_id);
        }

        return view('Vendas.cadastro', compact('produtoSelecionado', 'funcionarios'));
    }
    public function salvarVenda(Request $request)
    {
        // Verificar se é uma requisição AJAX com múltiplos produtos
        if ($request->isJson() && $request->has('produtos')) {
            return $this->salvarVendaMultipla($request);
        }
        
        // Manter compatibilidade com o método antigo (um produto por vez)
        $request->validate([
            'produto_id' => 'required|exists:Produtos,id',
            'quantidade' => 'required|integer|min:1',
            'funcionario_id' => 'required|exists:funcionarios,id',
        ]);
        
        $produto = Produto::find($request->produto_id);
        if (!$produto || $produto->quantidade < $request->quantidade) {
            return redirect()->back()->withErrors(['erro' => 'Produto sem estoque suficiente.']);
        }
        
        $precoTotal = $produto->preco * $request->quantidade;
        Venda::create([
            'produto_id' => $produto->id,
            'funcionario_id' => $request->funcionario_id,
            'quantidade' => $request->quantidade,
            'preco_total' => $precoTotal,
        ]);
        
        $produto->quantidade -= $request->quantidade;
        $produto->save();
        
        return redirect()->route('Vendas.cadastro')->with('success', 'Venda realizada com sucesso!');
    }

    private function salvarVendaMultipla(Request $request)
    {
        try {
            $produtos = $request->input('produtos');
            
            if (empty($produtos) || !is_array($produtos)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhum produto fornecido para a venda.'
                ], 400);
            }

            // Validar cada produto
            foreach ($produtos as $produtoData) {
                if (!isset($produtoData['produto_id']) || !isset($produtoData['quantidade']) || !isset($produtoData['preco_total'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Dados do produto incompletos.'
                    ], 400);
                }

                $produto = Produto::find($produtoData['produto_id']);
                if (!$produto) {
                    return response()->json([
                        'success' => false,
                        'message' => "Produto ID {$produtoData['produto_id']} não encontrado."
                    ], 400);
                }

                if ($produto->quantidade < $produtoData['quantidade']) {
                    return response()->json([
                        'success' => false,
                        'message' => "Estoque insuficiente para o produto: {$produto->nome}. Disponível: {$produto->quantidade}, Solicitado: {$produtoData['quantidade']}"
                    ], 400);
                }
            }

            // Processar cada venda
            foreach ($produtos as $produtoData) {
                $produto = Produto::find($produtoData['produto_id']);
                
                // Criar registro de venda
                Venda::create([
                    'produto_id' => $produto->id,
                    'funcionario_id' => $request->input('funcionario_id'),
                    'quantidade' => $produtoData['quantidade'],
                    'preco_total' => $produtoData['preco_total'],
                ]);
                
                // Atualizar estoque
                $produto->quantidade -= $produtoData['quantidade'];
                $produto->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Venda realizada com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor: ' . $e->getMessage()
            ], 500);
        }
    }
    public function buscarProduto(Request $request)
    {
        // Duplo modo: busca por termo (lista) ou produto_id (detalhe)
        if ($request->filled('termo')) {
            $termo = $request->input('termo');
            $produtos = Produto::query()
                ->with('fornecedor')
                ->where('nome', 'like', "%{$termo}%")
                ->orWhere('id', $termo)
                ->limit(10)
                ->get()
                ->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'nome' => $p->nome,
                        'marca' => $p->marca ?? optional($p->fornecedor)->nome,
                        'preco' => $p->preco,
                        'quantidade' => $p->quantidade
                    ];
                });
            return response()->json(['success' => true, 'resultados' => $produtos]);
        }

        $request->validate([
            'produto_id' => 'required|exists:Produtos,id',
        ]);

        $produtoSelecionado = Produto::with('fornecedor')->find($request->produto_id);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'produto' => [
                    'id' => $produtoSelecionado->id,
                    'nome' => $produtoSelecionado->nome,
                    'marca' => $produtoSelecionado->marca ?? ($produtoSelecionado->fornecedor->nome ?? 'N/A'),
                    'preco' => $produtoSelecionado->preco,
                    'quantidade' => $produtoSelecionado->quantidade
                ]
            ]);
        }

        $funcionarios = Funcionario::all();
        return view('Vendas.cadastro', compact('produtoSelecionado', 'funcionarios'));
    }
}
