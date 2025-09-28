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
        Schema::table('sales', function (Blueprint $table) {
            // Adiciona as colunas após 'total_price' para manter a organização
            $table->decimal('fee_percentage', 8, 4)->nullable()->after('total_price'); // Taxa em % (ex: 4.9900)
            $table->decimal('fee_fixed', 10, 2)->nullable()->after('fee_percentage'); // Taxa fixa em R$ (ex: 0.40)
            $table->decimal('fee_total', 10, 2)->nullable()->after('fee_fixed'); // Soma das taxas
            $table->decimal('net_amount', 10, 2)->nullable()->after('fee_total'); // Valor líquido para o vendedor
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn(['fee_percentage', 'fee_fixed', 'fee_total', 'net_amount']);
        });
    }
};
