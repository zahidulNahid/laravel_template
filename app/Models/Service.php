<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'icon',
        'title1', 'icon1',
        'title2', 'icon2',
        'title3', 'icon3',
        'title4', 'icon4',
        'title5', 'icon5',
        'title6', 'icon6',
        'title7', 'icon7',
        'title', 
    ];

    
}
