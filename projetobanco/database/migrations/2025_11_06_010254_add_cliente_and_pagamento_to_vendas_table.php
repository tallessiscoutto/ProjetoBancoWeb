<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            if (!Schema::hasColumn('vendas', 'cliente_id')) {
                $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('set null');
            }
            if (!Schema::hasColumn('vendas', 'forma_pagamento')) {
                $table->string('forma_pagamento', 50)->nullable()->default('Dinheiro');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            if (Schema::hasColumn('vendas', 'cliente_id')) {
                $table->dropForeign(['cliente_id']);
                $table->dropColumn('cliente_id');
            }
            if (Schema::hasColumn('vendas', 'forma_pagamento')) {
                $table->dropColumn('forma_pagamento');
            }
        });
    }
};
