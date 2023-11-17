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
        Schema::create('garden_saves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garden_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('saved_with')->nullable()->default('0.0.1');
            $table->json('data')->nullable();
            $table->boolean('autosave')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garden_saves');
    }
};
