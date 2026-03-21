<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Produto;
use App\Models\Funcionario;

class RF_F01Controller extends Controller
{
    public function cadastrarCompra()
    {
        $produtos = Produto::all();
        $funcionarios = Funcionario::all();
        $compras = Compra::with(['produto','funcionario'])->get();
        return view('Compras.cadastro', ['produtos' => $produtos, 'compras' => $compras, 'funcionarios' => $funcionarios]);
    }

    public function salvarCompra(Request $request)
    {
        $request->validate([
            'produto_id'   => 'required|exists:produtos,id',
            'quantidade'   => 'required|integer|min:1',
            'preco_total'  => 'required|numeric|min:0',
            'data_compra'  => 'required|date',
            'funcionario_id' => 'required|exists:funcionarios,id',
        ]);
        Compra::create([
            'produto_id'  => $request->produto_id,
            'funcionario_id' => $request->funcionario_id,
            'quantidade'  => $request->quantidade,
            'preco_total' => $request->preco_total,
            'data_compra' => $request->data_compra,
        ]);
        $produto = Produto::find($request->produto_id);
        if ($produto) {
            $produto->quantidade += $request->quantidade;
            $produto->save();
        }
        return redirect()->route('Compras.cadastro')->with('success', 'Compra registrada com sucesso!');
    }
    public function editarCompra($id)
    {
        $compra = Compra::findOrFail($id);
        $produtos = Produto::all();
        $funcionarios = Funcionario::all();
        return view('Compras.editar', compact('compra', 'produtos', 'funcionarios'));
    }
    public function atualizarCompra(Request $request, $id)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco_total' => 'required|numeric|min:0',
            'data_compra' => 'required|date',
            'funcionario_id' => 'required|exists:funcionarios,id',
        ]);
        $compra = Compra::findOrFail($id);
        $compra->update([
            'produto_id' => $request->produto_id,
            'funcionario_id' => $request->funcionario_id,
            'quantidade' => $request->quantidade,
            'preco_total' => $request->preco_total,
            'data_compra' => $request->data_compra,
        ]);
        return redirect()->route('Compras.cadastro')->with('success', 'Compra atualizada com sucesso!');
    }
    public function excluirCompra($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->delete();
        return redirect()->route('Compras.cadastro')->with('success', 'Compra excluída com sucesso!');
    }
}
