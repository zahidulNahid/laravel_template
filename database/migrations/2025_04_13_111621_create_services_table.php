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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('heading')->nullable();
            $table->string('icon')->nullable();

            $table->string('title1')->nullable();
            $table->string('icon1')->nullable();

            $table->string('title2')->nullable();
            $table->string('icon2')->nullable();

            $table->string('title3')->nullable();
            $table->string('icon3')->nullable();

            $table->string('title4')->nullable();
            $table->string('icon4')->nullable();

            $table->string('title5')->nullable();
            $table->string('icon5')->nullable();

            $table->string('title6')->nullable();
            $table->string('icon6')->nullable();

            $table->string('title7')->nullable();
            $table->string('icon7')->nullable();

            $table->string('title')->nullable();







            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
