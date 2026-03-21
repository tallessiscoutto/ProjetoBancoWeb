<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('cliente_id');
            $table->integer('quantidade');
            $table->date('data_inicio');
            $table->date('data_fim_prevista');
            $table->date('data_devolucao')->nullable();
            $table->decimal('valor_diaria', 10, 2)->default(0);
            $table->decimal('valor_total', 10, 2)->default(0);
            $table->string('status')->default('ativa');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos')->cascadeOnDelete();
            $table->foreign('cliente_id')->references('id')->on('clientes')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locacoes');
    }
};







