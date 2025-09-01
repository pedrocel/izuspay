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
        Schema::table('ledger_entries', function (Blueprint $table) {
            // Altera a coluna 'related_id' para o tipo UUID
            // O Laravel usará VARCHAR(36) por baixo dos panos, que é o ideal.
            $table->uuid('related_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ledger_entries', function (Blueprint $table) {
            // Código para reverter a alteração, caso precise
            $table->unsignedBigInteger('related_id')->nullable()->change();
        });
    }
};
