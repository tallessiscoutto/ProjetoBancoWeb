<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('Produtos');
            $table->integer('quantidade');
            $table->decimal('preco_total', 10, 2);
            $table->timestamps();
        });
        
    }
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
