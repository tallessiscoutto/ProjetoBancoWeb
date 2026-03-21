<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->date('data_venda')->after('preco_total')->nullable();
        });
    }
    public function down(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            //
        });
    }
};
