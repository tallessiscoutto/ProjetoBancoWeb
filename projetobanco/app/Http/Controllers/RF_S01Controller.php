<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Funcionario;
use Barryvdh\DomPDF\Facade\Pdf;

class RF_S01Controller extends Controller
{
    public function relatorioVendas(Request $request)
    {
        $query = Venda::with(['produto', 'funcionario']);

        // Aplicar filtros se existirem
        if ($request->data_inicio) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }
        if ($request->data_fim) {
            $query->whereDate('created_at', '<=', $request->data_fim);
        }

        if ($request->filled('produto')) {
            $termo = $request->input('produto');
            $query->whereHas('produto', function ($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%");
            });
        }

        if ($request->filled('funcionario')) {
            $termo = $request->input('funcionario');
            $query->whereHas('funcionario', function ($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%");
            });
        }

        $vendas = $query->get();
        return view('Relatorios.vendas', compact('vendas'));
    }

    public function gerarPDF(Request $request)
    {
        $query = Venda::with(['produto', 'funcionario']);

        // Aplicar os mesmos filtros do relatório
        if ($request->data_inicio) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }
        if ($request->data_fim) {
            $query->whereDate('created_at', '<=', $request->data_fim);
        }

        if ($request->filled('produto')) {
            $termo = $request->input('produto');
            $query->whereHas('produto', function ($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%");
            });
        }

        if ($request->filled('funcionario')) {
            $termo = $request->input('funcionario');
            $query->whereHas('funcionario', function ($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%");
            });
        }

        $vendas = $query->get();

        // Agrupar por "venda" (aproximação: cliente + funcionário + data_venda + forma_pagamento)
        $grupos = $vendas->groupBy(function ($v) {
            $cliente = $v->cliente_id ?? 'sem_cliente';
            $func = $v->funcionario_id ?? 'sem_funcionario';
            $data = $v->data_venda ?? optional($v->created_at)->format('Y-m-d');
            $pag = $v->forma_pagamento ?? 'N/D';
            return implode('|', [$cliente, $func, $data, $pag]);
        });

        $gruposDetalhados = $grupos->map(function ($items) {
            $primeiro = $items->first();
            return [
                'cliente' => optional($primeiro->cliente)->nome ?? '—',
                'funcionario' => optional($primeiro->funcionario)->nome ?? '—',
                'data_venda' => $primeiro->data_venda ?? optional($primeiro->created_at)->format('Y-m-d'),
                'forma_pagamento' => $primeiro->forma_pagamento ?? 'N/D',
                'total_venda' => $items->sum('preco_total'),
                'itens' => $items->map(function ($v) {
                    return [
                        'produto' => optional($v->produto)->nome ?? '—',
                        'quantidade' => $v->quantidade,
                        'preco_unitario' => optional($v->produto)->preco ?? 0,
                        'preco_total' => $v->preco_total,
                        'id' => $v->id,
                    ];
                })->values(),
            ];
        })->values();

        $totalGeral = $gruposDetalhados->sum('total_venda');
        $totalVendas = $gruposDetalhados->count();
        $maiorVenda = $gruposDetalhados->max('total_venda') ?? 0;
        $mediaVendas = $totalVendas > 0 ? $totalGeral / $totalVendas : 0;

        $pdf = PDF::loadView('Relatorios.vendas_pdf', [
            'grupos' => $gruposDetalhados,
            'total_vendas' => $totalVendas,
            'media_vendas' => $mediaVendas,
            'maior_venda' => $maiorVenda,
            'total_geral' => $totalGeral
        ]);

        return $pdf->download('relatorio-vendas.pdf');
    }

    public function exportarExcel(Request $request)
    {
        $query = Venda::with('produto');

        if ($request->data_inicio) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }
        if ($request->data_fim) {
            $query->whereDate('created_at', '<=', $request->data_fim);
        }
        if ($request->filled('produto')) {
            $termo = $request->input('produto');
            $query->whereHas('produto', function ($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%");
            });
        }

        $vendas = $query->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="relatorio-vendas.csv"',
        ];

        $callback = function () use ($vendas) {
            $saida = fopen('php://output', 'w');
            // BOM para Excel reconhecer UTF-8
            fprintf($saida, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($saida, ['ID', 'Produto', 'Quantidade', 'Valor Unitário', 'Valor Total', 'Data', 'Funcionário'], ';');

            foreach ($vendas as $venda) {
                fputcsv($saida, [
                    $venda->id,
                    optional($venda->produto)->nome,
                    $venda->quantidade,
                    number_format(optional($venda->produto)->preco ?? 0, 2, ',', '.'),
                    number_format($venda->preco_total, 2, ',', '.'),
                    optional($venda->created_at)?->format('d/m/Y H:i'),
                    optional($venda->funcionario)->nome,
                ], ';');
            }

            fclose($saida);
        };

        return response()->stream($callback, 200, $headers);
    }
}
