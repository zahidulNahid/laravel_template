<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email_address',
        'phone_number',
        'company_name',
        'customer_address',
        'site_location',
        'type_of_service',
        'project_description',
        'building_plans',
        'upload_building_plans',
        'requested_time_and_date',
        'start_date',
        'budget_range',
        'how_do_you_know_about_us',
    ];

    protected $casts = [
        'requested_time_and_date' => 'datetime',
        'start_date' => 'date',
    ];
}
