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
        Schema::create('ricevutas', function (Blueprint $table) {
            $table->id();
            $table->text('destinatario')->nullable();
            $table->text('indirizzo')->nullable();
            $table->text('citta')->nullable();
            $table->text('cap')->nullable();
            $table->text('pivaCodfisc')->nullable();
            $table->float('importo')->nullable();
            $table->text('modalitaPagamento')->nullable();
            $table->text('descrizione')->nullable();
            $table->date('dataRicevuta')->nullable();
            $table->integer('anno')->nullable();
            $table->integer('progressivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ricevutas');
    }
};
