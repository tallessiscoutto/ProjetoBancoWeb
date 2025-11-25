<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório de Vendas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #333;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .resumo {
            margin-top: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .resumo h2 {
            color: #333;
            margin-top: 0;
        }
        .resumo-item {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RELATÓRIO MENSAL DE VENDAS</h1>
        <p>Gerado em {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
    </div>

    @if(!empty($resumo_mensal) && count($resumo_mensal) > 0)
        {{-- Cabeçalho no estilo do template (vendedor / data + totais à direita) --}}
        <table style="margin-bottom: 30px; border: none;">
            <tr>
                <td style="border: none; width: 60%; vertical-align: top;">
                    <table style="width: 100%; border: none;">
                        <tr>
                            <td style="border: none; width: 30%; font-weight: bold;">VENDEDOR / LOJA</td>
                            <td style="border: none; border-bottom: 1px solid #ccc;">
                                Perfumes da Chiquinha
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none; font-weight: bold; padding-top: 10px;">PERÍODO</td>
                            <td style="border: none; border-bottom: 1px solid #ccc; padding-top: 10px;">
                                Relatório consolidado por mês
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border: none; width: 40%; vertical-align: top;">
                    <table style="width: 100%; border: none;">
                        @php
                            $valorBrutoGeral = $total_geral;
                            $impostosGerais = 0; // sistema não possui impostos cadastrados
                            $valorLiquidoGeral = $valorBrutoGeral - $impostosGerais;
                        @endphp
                        <tr>
                            <td style="border: none; text-align: right; font-weight: bold;">VALOR BRUTO</td>
                            <td style="border: none; text-align: right;">
                                R$ {{ number_format($valorBrutoGeral, 2, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none; text-align: right; font-weight: bold;">IMPOSTOS</td>
                            <td style="border: none; text-align: right;">
                                R$ {{ number_format($impostosGerais, 2, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none; text-align: right; font-weight: bold;">VALOR LÍQUIDO</td>
                            <td style="border: none; text-align: right;">
                                R$ {{ number_format($valorLiquidoGeral, 2, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        {{-- Tabela principal no formato parecido com o modelo --}}
        <table>
            <thead>
                <tr>
                    <th>MÊS</th>
                    <th>QTD. VENDAS</th>
                    <th>VALOR BRUTO</th>
                    <th>IMPOSTOS</th>
                    <th>VALOR LÍQUIDO</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $somaBruto = 0;
                    $somaImpostos = 0;
                    $somaLiquido = 0;
                @endphp
                @foreach($resumo_mensal as $mes)
                    @php
                        $bruto = $mes['valor_bruto'];
                        $imposto = $mes['valor_bruto'] - $mes['valor_liquido']; // hoje será 0
                        $liquido = $mes['valor_liquido'];
                        $somaBruto += $bruto;
                        $somaImpostos += $imposto;
                        $somaLiquido += $liquido;
                    @endphp
                    <tr>
                        <td>{{ $mes['mes'] }}</td>
                        <td>{{ $mes['quantidade_vendas'] }}</td>
                        <td>R$ {{ number_format($bruto, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($imposto, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($liquido, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($liquido, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td><strong>TOTAL</strong></td>
                    <td><strong>{{ $total_vendas }}</strong></td>
                    <td><strong>R$ {{ number_format($somaBruto, 2, ',', '.') }}</strong></td>
                    <td><strong>R$ {{ number_format($somaImpostos, 2, ',', '.') }}</strong></td>
                    <td><strong>R$ {{ number_format($somaLiquido, 2, ',', '.') }}</strong></td>
                    <td><strong>R$ {{ number_format($somaLiquido, 2, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        {{-- Bloco de informações importantes --}}
        <div class="resumo">
            <h2>Informações Importantes</h2>
            <div class="resumo-item">
                <strong>Total de Vendas (todas as linhas):</strong> {{ $total_vendas }}
            </div>
            <div class="resumo-item">
                <strong>Média por Venda:</strong> R$ {{ number_format($media_vendas, 2, ',', '.') }}
            </div>
            <div class="resumo-item">
                <strong>Maior Venda Individual:</strong> R$ {{ number_format($maior_venda, 2, ',', '.') }}
            </div>
            <div class="resumo-item">
                <strong>Total Geral do Período:</strong> R$ {{ number_format($total_geral, 2, ',', '.') }}
            </div>

            @if(!empty($melhor_mes))
                <div class="resumo-item" style="margin-top: 15px;">
                    <strong>Melhor mês em faturamento:</strong>
                    {{ $melhor_mes['mes'] }} (R$ {{ number_format($melhor_mes['valor_liquido'], 2, ',', '.') }})
                </div>
            @endif
        </div>
    @else
        <p>Não há vendas no período selecionado.</p>
    @endif
</body>
</html> 