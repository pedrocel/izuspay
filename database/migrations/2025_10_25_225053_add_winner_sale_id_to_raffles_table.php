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
        Schema::table('raffles', function (Blueprint $table) {
            $table->unsignedBigInteger('winner_sale_id')->nullable()->after('status');
            $table->foreign('winner_sale_id')
                  ->references('id')
                  ->on('raffles_sales')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->dropForeign(['winner_sale_id']);
            $table->dropColumn('winner_sale_id');
        });
    }
};
