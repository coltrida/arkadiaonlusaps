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
        Schema::create('activities_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Activity::class);
            $table->foreignIdFor(\App\Models\Client::class);
            $table->float('quantita');
            $table->float('costo');
            $table->date('giorno');
            $table->integer('mese');
            $table->integer('anno');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_clients');
    }
};
