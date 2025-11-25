<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Reserva;
use App\Models\Produto;
use App\Models\Cliente;

class RF_R01Controller extends Controller
{
    public function cadastrarReserva(Request $request)
    {
        $produtos = Produto::orderBy('nome')->get();
        $clientes = Cliente::orderBy('nome')->get();

        // Pré-seleções vindas da tela de Vendas
        $produtoSelecionadoId = $request->input('produto_id');
        $clienteSelecionadoId = $request->input('cliente_id');
        $quantidadeSugerida = $request->input('quantidade');

        // Itens vindos da tela de vendas (pode haver mais de um produto)
        $itensVenda = [];
        if ($request->filled('itens')) {
            $raw = json_decode($request->input('itens'), true);
            if (is_array($raw)) {
                $ids = collect($raw)->pluck('produto_id')->filter()->unique()->all();
                $mapaProdutos = Produto::whereIn('id', $ids)->get()->keyBy('id');

                $itensVenda = collect($raw)->map(function ($item) use ($mapaProdutos) {
                    $produto = $mapaProdutos->get($item['produto_id'] ?? null);
                    return [
                        'produto_id' => $item['produto_id'] ?? null,
                        'nome' => $produto?->nome ?? 'Produto não encontrado',
                        'quantidade' => (int)($item['quantidade'] ?? 1),
                        'estoque' => $produto?->quantidade ?? 0,
                    ];
                })->toArray();
            }
        }

        $query = Reserva::with(['produto','cliente']);
        if ($request->filled('cliente')) {
            $termo = $request->input('cliente');
            $query->whereHas('cliente', function($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%");
            });
        }
        if ($request->filled('produto')) {
            $termo = $request->input('produto');
            $query->whereHas('produto', function($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('inicio')) {
            $query->whereDate('created_at', '>=', $request->input('inicio'));
        }
        if ($request->filled('fim')) {
            $query->whereDate('created_at', '<=', $request->input('fim'));
        }

        $reservas = $query->orderByDesc('id')->paginate(10)->withQueryString();
        return view('Reservas.cadastro', compact(
            'produtos',
            'clientes',
            'reservas',
            'produtoSelecionadoId',
            'clienteSelecionadoId',
            'quantidadeSugerida',
            'itensVenda'
        ));
    }

    public function salvarReserva(Request $request)
    {
        // Caso venha um conjunto de itens da tela de vendas,
        // criamos várias reservas de uma vez (uma por produto).
        if ($request->filled('itens_venda')) {
            $itens = json_decode($request->input('itens_venda'), true) ?: [];

            if (!is_array($itens) || empty($itens)) {
                return back()->withErrors(['itens_venda' => 'Não foi possível importar os itens da venda.'])->withInput();
            }

            $request->validate([
                'cliente_id' => 'required|exists:clientes,id',
                'data_validade' => 'required|date|after:today',
            ]);

            try {
                DB::transaction(function () use ($itens, $request) {
                    foreach ($itens as $item) {
                        $produtoId = $item['produto_id'] ?? null;
                        $quantidade = max(1, (int)($item['quantidade'] ?? 1));

                        if (!$produtoId) {
                            continue;
                        }

                        $produto = Produto::findOrFail($produtoId);
                        if ($produto->quantidade < $quantidade) {
                            throw ValidationException::withMessages([
                                'estoque' => "Estoque insuficiente para o produto {$produto->nome}.",
                            ]);
                        }

                        Reserva::create([
                            'produto_id' => $produtoId,
                            'cliente_id' => $request->cliente_id,
                            'quantidade' => $quantidade,
                            'data_validade' => $request->data_validade,
                            'status' => 'ativa',
                        ]);
                    }
                });
            } catch (ValidationException $e) {
                throw $e;
            }

            return redirect()->route('Reservas.cadastro')->with('success', 'Reservas criadas com sucesso a partir da venda!');
        }

        // Fluxo padrão: uma única reserva manual
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'quantidade' => 'required|integer|min:1',
            'data_validade' => 'required|date|after:today',
        ]);

        $produto = Produto::findOrFail($request->produto_id);
        if ($produto->quantidade < $request->quantidade) {
            return back()->withErrors(['estoque' => 'Estoque insuficiente para reservar.']);
        }

        Reserva::create([
            'produto_id' => $request->produto_id,
            'cliente_id' => $request->cliente_id,
            'quantidade' => $request->quantidade,
            'data_validade' => $request->data_validade,
            'status' => 'ativa',
        ]);

        return redirect()->route('Reservas.cadastro')->with('success', 'Reserva criada com sucesso!');
    }

    public function concluirReserva($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->status = 'concluida';
        $reserva->save();
        return redirect()->route('Reservas.cadastro')->with('success', 'Reserva concluída!');
    }

    public function cancelarReserva($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->status = 'cancelada';
        $reserva->save();
        return redirect()->route('Reservas.cadastro')->with('success', 'Reserva cancelada!');
    }
}


