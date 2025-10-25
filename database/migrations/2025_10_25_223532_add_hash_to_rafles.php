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
            $table->string('hash_id')->unique()->after('id');
        });

        // Gera hash_id para rifas existentes
        DB::table('raffles')->get()->each(function ($raffle) {
            DB::table('raffles')
                ->where('id', $raffle->id)
                ->update(['hash_id' => \Illuminate\Support\Str::random(10)]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->dropColumn('hash_id');
        });
    }
};
