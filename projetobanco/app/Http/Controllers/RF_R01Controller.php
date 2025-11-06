<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Produto;
use App\Models\Cliente;

class RF_R01Controller extends Controller
{
    public function cadastrarReserva(Request $request)
    {
        $produtos = Produto::orderBy('nome')->get();
        $clientes = Cliente::orderBy('nome')->get();

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
        return view('Reservas.cadastro', compact('produtos','clientes','reservas'));
    }

    public function salvarReserva(Request $request)
    {
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

        // Opcional: não baixar do estoque agora; apenas bloquear logicamente em processos futuros
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


