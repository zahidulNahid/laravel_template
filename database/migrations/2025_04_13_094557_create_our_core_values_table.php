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
        Schema::create('our_core_values', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('description1')->nullable();
            $table->longText('description2')->nullable();
            $table->string('img')->nullable();
            $table->string('icon1')->nullable();
            $table->string('icon2')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_core_values');
    }
};
