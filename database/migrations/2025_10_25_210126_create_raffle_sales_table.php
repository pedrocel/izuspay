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
        Schema::create('raffle_sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('raffle_id')->constrained()->cascadeOnDelete()->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_email')->nullable();
            $table->string('buyer_phone')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->nullable()->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('transaction_hash')->nullable();
            $table->decimal('fee_total', 10, 2)->nullable()->default(0);
            $table->decimal('net_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
