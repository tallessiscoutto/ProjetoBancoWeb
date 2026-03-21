<?php

namespace Database\Seeders;

use App\Models\Funcionario;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    public function run(): void
    {
        $funcionarios = [
            [
                'nome' => 'Rodrigo de Assis Siscoutto',
                'documento' => '12345678901',
                'salario' => 3500.00,
                'cargo' => 'Vendedor',
                'email' => 'rodrigo.siscoutto@perfumes.com'
            ],
            [
                'nome' => 'Ana Paula Silva',
                'documento' => '98765432100',
                'salario' => 3200.00,
                'cargo' => 'Vendedora',
                'email' => 'ana.silva@perfumes.com'
            ],
            [
                'nome' => 'Carlos Roberto',
                'documento' => '11122233344',
                'salario' => 3800.00,
                'cargo' => 'Gerente',
                'email' => 'carlos.roberto@perfumes.com'
            ],
            [
                'nome' => 'Juliana Ferreira',
                'documento' => '55566677788',
                'salario' => 3000.00,
                'cargo' => 'Vendedora',
                'email' => 'juliana.ferreira@perfumes.com'
            ],
            [
                'nome' => 'Roberto Alves',
                'documento' => '99988877766',
                'salario' => 2800.00,
                'cargo' => 'Estoquista',
                'email' => 'roberto.alves@perfumes.com'
            ]
        ];

        foreach ($funcionarios as $funcionario) {
            Funcionario::create($funcionario);
        }
    }
}

