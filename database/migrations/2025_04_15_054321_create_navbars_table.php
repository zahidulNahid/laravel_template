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
        Schema::create('navbars', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('back_img')->nullable();
            $table->string('itemname1')->nullable();
            $table->string('itemlink1')->nullable();
            $table->string('itemname2')->nullable();
            $table->string('itemlink2')->nullable();
            $table->string('itemname3')->nullable();
            $table->string('itemlink3')->nullable();
            $table->string('itemname4')->nullable();
            $table->string('itemlink4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navbars');
    }
};
