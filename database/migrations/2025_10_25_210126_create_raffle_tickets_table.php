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
        Schema::create('raffle_tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('raffle_id');
            $table->integer('number');
            $table->enum('status', ['available', 'sold'])->default('available');
            $table->uuid('raffle_sale_id')->nullable();
            $table->foreign('raffle_sale_id')
                  ->references('id')
                  ->on('raffle_sales')
                  ->nullOnDelete();
            $table->timestamps();
            $table->unique(['raffle_id', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
