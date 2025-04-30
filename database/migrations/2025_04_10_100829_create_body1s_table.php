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
        Schema::create('body1s', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();

            $table->string('title1')->nullable();
            $table->longText('description1')->nullable();

            $table->string('title2')->nullable();
            $table->longText('description2')->nullable();

            $table->string('img1')->nullable();
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();

            $table->string('title3')->nullable();
            $table->longText('description3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('body1s');
    }
};
