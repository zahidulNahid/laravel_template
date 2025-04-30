<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSec2 extends Model
{
    use HasFactory;
    protected $fillable = [
        'title1', 'description1', 'icon1',
        'title2', 'description2', 'icon2',
        'title3', 'description3', 'icon3',
        'title4', 'description4', 'icon4',
        'title5', 'description5', 'icon5',
        'img', 'video',
    ];
    
}
