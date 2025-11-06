<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Funcionario;
use App\Models\Venda;
use App\Models\Compra;
use App\Models\Reserva;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $stats = [
                'produtos' => Produto::count(),
                'produtos_estoque_baixo' => Produto::where('quantidade', '<', 10)->count(),
                'clientes' => Cliente::count(),
                'fornecedores' => Fornecedor::count(),
                'funcionarios' => Funcionario::count(),
                'vendas_hoje' => Venda::whereDate('created_at', today())->count(),
                'vendas_mes' => Venda::whereMonth('created_at', now()->month)->count(),
                'total_vendas' => Venda::sum('preco_total') ?? 0,
                'compras_mes' => Compra::whereMonth('data_compra', now()->month)->count(),
                'reservas_ativas' => Reserva::where('status', 'pendente')->orWhere('status', 'ativa')->orWhereNull('status')->count(),
                'funcionarios_recentes' => Funcionario::orderBy('created_at', 'desc')->limit(5)->get(),
            ];
        } catch (\Exception $e) {
            // Se houver erro, retorna valores padrão
            $stats = [
                'produtos' => 0,
                'produtos_estoque_baixo' => 0,
                'clientes' => 0,
                'fornecedores' => 0,
                'funcionarios' => 0,
                'vendas_hoje' => 0,
                'vendas_mes' => 0,
                'total_vendas' => 0,
                'compras_mes' => 0,
                'reservas_ativas' => 0,
                'funcionarios_recentes' => collect(),
            ];
        }

        return view('home', compact('stats'));
    }
}

