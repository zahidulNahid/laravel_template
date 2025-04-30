<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading',
        'title1', 'description1', 'img1',
        'title2', 'description2', 'img2',
        'title3', 'description3', 'img3',
        'title4', 'description4', 'img4',
    ];

}
