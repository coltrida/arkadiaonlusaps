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
        Schema::create('primanotas', function (Blueprint $table) {
            $table->id();
            $table->float('importo');
            $table->string('causale');
            $table->string('progressivo')->nullable();
            $table->foreignIdFor(\App\Models\User::class);
            $table->integer('anno');
            $table->integer('mese');
            $table->date('giorno');
            $table->string('tipo');
            $table->string('fornitore')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primanotas');
    }
};
