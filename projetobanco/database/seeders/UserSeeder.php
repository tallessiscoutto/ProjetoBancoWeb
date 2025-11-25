<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'chiquinha@gmail.com'],
            [
                'name' => 'Usuária Padrão',
                'password' => '123', // será automaticamente hasheada pelo cast em App\Models\User
                'role' => 'admin',
            ]
        );
    }
}


