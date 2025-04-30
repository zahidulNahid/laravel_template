<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Body1 extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading',
        'title1',
        'description1',
        'title2',
        'description2',
        'img1',
        'img2',
        'img3',
        'title3',
        'description3',
    ];
    
}
