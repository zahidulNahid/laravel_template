<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectRequestsTable extends Migration
{
    public function up(): void
    {
        Schema::create('project_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('company_name')->nullable();
            $table->text('customer_address')->nullable();
            $table->text('site_location')->nullable();
            $table->text('type_of_service')->nullable();
            $table->longText('project_description')->nullable();
            $table->string('building_plans')->nullable();
            $table->string('upload_building_plans')->nullable();
            $table->timestamp('requested_time_and_date')->nullable();
            $table->date('start_date')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('how_do_you_know_about_us')->nullable();
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_requests');
    }
}
