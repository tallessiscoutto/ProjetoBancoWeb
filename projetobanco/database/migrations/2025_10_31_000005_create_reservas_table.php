<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('cliente_id');
            $table->integer('quantidade');
            $table->date('data_validade');
            $table->string('status')->default('ativa');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos')->cascadeOnDelete();
            $table->foreign('cliente_id')->references('id')->on('clientes')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};


