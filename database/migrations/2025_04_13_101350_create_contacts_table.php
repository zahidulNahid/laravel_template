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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('color')->nullable(); // Color field (e.g., hex color code)
            $table->string('title')->nullable(); // Title field
            $table->string('subtitle')->nullable(); // Subtitle field
            $table->string('button_name')->nullable(); // Button name
            $table->string('button_url')->nullable(); // Button URL

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
