<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fornecedores = [
            [
                'nome' => 'Avon Cosméticos',
                'documento' => '12345678000190',
                'email' => 'contato@avon.com',
                'telefone' => '11987654321',
                'endereco' => 'Av. Avon, 1000 - São Paulo/SP',
                'produtos_disponiveis' => 'Perfumes, Cosméticos, Maquiagem',
                'formas_pagamento' => 'Boleto, Cartão, PIX'
            ],
            [
                'nome' => 'Natura Cosméticos',
                'documento' => '98765432000123',
                'email' => 'compras@natura.com',
                'telefone' => '11987654322',
                'endereco' => 'Rua Natura, 500 - São Paulo/SP',
                'produtos_disponiveis' => 'Perfumes, Produtos de Beleza',
                'formas_pagamento' => 'Boleto, Cartão, PIX, Dinheiro'
            ],
            [
                'nome' => 'O Boticário',
                'documento' => '11122233000144',
                'email' => 'fornecedor@boticario.com',
                'telefone' => '11987654323',
                'endereco' => 'Av. Boticário, 200 - Curitiba/PR',
                'produtos_disponiveis' => 'Perfumes, Cosméticos',
                'formas_pagamento' => 'Cartão, PIX'
            ],
            [
                'nome' => 'Distribuidora de Cosméticos LTDA',
                'documento' => '55566677000188',
                'email' => 'vendas@distcosmeticos.com',
                'telefone' => '11987654324',
                'endereco' => 'Rua dos Cosméticos, 300 - São Paulo/SP',
                'produtos_disponiveis' => 'Shampoos, Condicionadores, Sabonetes',
                'formas_pagamento' => 'Boleto, Cartão'
            ]
        ];

        foreach ($fornecedores as $fornecedor) {
            Fornecedor::create($fornecedor);
        }
    }
}
