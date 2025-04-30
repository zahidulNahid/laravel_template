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
        Schema::create('about_sec2s', function (Blueprint $table) {
            $table->id();
            $table->string('title1')->nullable();
            $table->longText('description1')->nullable();
            $table->string('icon1')->nullable();

            $table->string('title2')->nullable();
            $table->longText('description2')->nullable();
            $table->string('icon2')->nullable();

            $table->string('title3')->nullable();
            $table->longText('description3')->nullable();
            $table->string('icon3')->nullable();

            $table->string('title4')->nullable();
            $table->longText('description4')->nullable();
            $table->string('icon4')->nullable();

            $table->string('title5')->nullable();
            $table->longText('description5')->nullable();
            $table->string('icon5')->nullable();

            $table->string('img')->nullable();    // image path or URL
            $table->string('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_sec2s');
    }
};
