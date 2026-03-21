<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); //PRIMARY KEY AUTO_INCREMENT
            $table->string('nome', 80); //VARCHAR(100)
            $table->string('documento',14)->unique();
            $table->string('email')->unique();
            $table->string('telefone', 15);
            $table->string('endereco',44 );
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
