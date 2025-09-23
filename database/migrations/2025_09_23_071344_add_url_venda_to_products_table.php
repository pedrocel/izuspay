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
        Schema::table('products', function (Blueprint $table) {
            // Adiciona a coluna 'url_venda' após a coluna 'categoria_produto'
            // O método nullable() permite que a coluna tenha valores nulos (vazios)
            $table->string('url_venda')->nullable()->after('categoria_produto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Remove a coluna 'url_venda' se a migration for revertida
            $table->dropColumn('url_venda');
        });
    }
};
