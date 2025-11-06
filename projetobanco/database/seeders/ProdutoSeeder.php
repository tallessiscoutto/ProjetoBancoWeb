<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar fornecedores
        $avon = Fornecedor::where('nome', 'like', '%Avon%')->first();
        $natura = Fornecedor::where('nome', 'like', '%Natura%')->first();
        $boticario = Fornecedor::where('nome', 'like', '%Boticário%')->first();
        $distribuidora = Fornecedor::where('nome', 'like', '%Distribuidora%')->first();
        
        // Se não encontrar, usar o primeiro disponível
        $fornecedorPadrao = Fornecedor::first();

        $produtos = [
            [
                'nome' => 'Perfume 150ml',
                'marca' => 'Avon',
                'descricao' => 'Perfume feminino de longa duração',
                'preco' => 89.90,
                'quantidade' => 50,
                'localizacao' => 'Estante A / Prateleira 1',
                'fornecedor_id' => $avon ? $avon->id : $fornecedorPadrao->id
            ],
            [
                'nome' => 'Perfume 150ml Rosa',
                'marca' => 'Avon',
                'descricao' => 'Perfume feminino com notas de rosa',
                'preco' => 95.00,
                'quantidade' => 30,
                'localizacao' => 'Estante A / Prateleira 2',
                'fornecedor_id' => $avon ? $avon->id : $fornecedorPadrao->id
            ],
            [
                'nome' => 'Perfumes 150 mls2',
                'marca' => 'Natura',
                'descricao' => 'Perfume premium 150ml',
                'preco' => 120.00,
                'quantidade' => 25,
                'localizacao' => 'Estante B / Prateleira 1',
                'fornecedor_id' => $natura ? $natura->id : $fornecedorPadrao->id
            ],
            [
                'nome' => 'Perfume Masculino Classic',
                'marca' => 'O Boticário',
                'descricao' => 'Perfume masculino clássico 100ml',
                'preco' => 110.00,
                'quantidade' => 40,
                'localizacao' => 'Estante B / Prateleira 2',
                'fornecedor_id' => $boticario ? $boticario->id : $fornecedorPadrao->id
            ],
            [
                'nome' => 'Shampoo Hidratante',
                'marca' => 'Pantene',
                'descricao' => 'Shampoo para cabelos secos 400ml',
                'preco' => 18.90,
                'quantidade' => 100,
                'localizacao' => 'Estante C / Prateleira 1',
                'fornecedor_id' => $distribuidora ? $distribuidora->id : $fornecedorPadrao->id
            ],
            [
                'nome' => 'Condicionador Reparador',
                'marca' => 'Pantene',
                'descricao' => 'Condicionador para cabelos danificados 400ml',
                'preco' => 19.90,
                'quantidade' => 85,
                'localizacao' => 'Estante C / Prateleira 1',
                'fornecedor_id' => $distribuidora ? $distribuidora->id : $fornecedorPadrao->id
            ],
            [
                'nome' => 'Sabonete Líquido',
                'marca' => 'Protex',
                'descricao' => 'Sabonete líquido antibacteriano 250ml',
                'preco' => 12.50,
                'quantidade' => 150,
                'localizacao' => 'Estante D / Prateleira 1',
                'fornecedor_id' => $distribuidora ? $distribuidora->id : $fornecedorPadrao->id
            ],
            [
                'nome' => 'Creme Hidratante Facial',
                'marca' => 'Nivea',
                'descricao' => 'Creme hidratante para o rosto 50g',
                'preco' => 25.00,
                'quantidade' => 60,
                'localizacao' => 'Estante D / Prateleira 2',
                'fornecedor_id' => $distribuidora ? $distribuidora->id : $fornecedorPadrao->id
            ],
            [
                'nome' => 'Desodorante Aerosol',
                'marca' => 'Rexona',
                'descricao' => 'Desodorante antitranspirante 150ml',
                'preco' => 14.90,
                'quantidade' => 120,
                'localizacao' => 'Estante E / Prateleira 1',
                'fornecedor_id' => $distribuidora ? $distribuidora->id : $fornecedorPadrao->id
            ],
            [
                'nome' => 'Perfume Importado',
                'marca' => 'Chanel',
                'descricao' => 'Perfume importado premium 100ml',
                'preco' => 450.00,
                'quantidade' => 10,
                'localizacao' => 'Estante A / Prateleira 3',
                'fornecedor_id' => $natura ? $natura->id : $fornecedorPadrao->id
            ]
        ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}

