<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder //Isso serve para que o seeder funcione
{
    /**
     * Seed the application's database.
     */
    public function run(): void //Isso serve para que o seeder funcione
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            CategoriaSeeder::class,
            FornecedorSeeder::class,
            ClienteSeeder::class,
            FuncionarioSeeder::class,
            ProdutoSeeder::class,
        ]);
    }
}
