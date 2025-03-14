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
        Schema::create('costoragazzos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Client::class);
            $table->integer('mese');
            $table->integer('anno');
            $table->float('contributo')->default(0);
            $table->float('totale');
            $table->float('saldo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costoragazzos');
    }
};
