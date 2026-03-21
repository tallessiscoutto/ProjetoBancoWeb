<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nome' => 'Maria Silva',
                'documento' => '12345678901',
                'email' => 'maria.silva@email.com',
                'telefone' => '11987654321',
                'endereco' => 'Rua das Flores, 123 - São Paulo/SP'
            ],
            [
                'nome' => 'João Santos',
                'documento' => '98765432100',
                'email' => 'joao.santos@email.com',
                'telefone' => '11987654322',
                'endereco' => 'Av. Paulista, 1000 - São Paulo/SP'
            ],
            [
                'nome' => 'Ana Costa',
                'documento' => '11122233344',
                'email' => 'ana.costa@email.com',
                'telefone' => '11987654323',
                'endereco' => 'Rua Augusta, 500 - São Paulo/SP'
            ],
            [
                'nome' => 'Pedro Oliveira',
                'documento' => '55566677788',
                'email' => 'pedro.oliveira@email.com',
                'telefone' => '11987654324',
                'endereco' => 'Rua Consolação, 200 - São Paulo/SP'
            ],
            [
                'nome' => 'Carla Mendes',
                'documento' => '99988877766',
                'email' => 'carla.mendes@email.com',
                'telefone' => '11987654325',
                'endereco' => 'Av. Rebouças, 300 - São Paulo/SP'
            ]
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}

