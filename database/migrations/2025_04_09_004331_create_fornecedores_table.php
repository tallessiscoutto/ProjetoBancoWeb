<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nome', 80);
            $table->string('documento',14)->unique();
            $table->string('endereco',44 );
            $table->string('produtos_disponiveis', 80);
            $table->string('formas_pagamento', 80);
            $table->string('telefone', 14);
            $table->string('email', 80)->unique();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
