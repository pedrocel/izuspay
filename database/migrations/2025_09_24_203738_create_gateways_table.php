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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ex: "Mercado Pago", "WiteTec"
            $table->string('slug')->unique(); // Ex: "mercado-pago", "witetec"
            $table->string('logo_url')->nullable(); // URL para a logo
            $table->boolean('is_active')->default(true); // Para habilitar/desabilitar
            $table->json('credentials_schema'); // Define os campos necessários (ex: client_id, client_secret)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
