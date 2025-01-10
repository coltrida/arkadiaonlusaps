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
        Schema::create('associa', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Activity::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Client::class);
            $table->unique(['activity_id','client_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associa');
    }
};
