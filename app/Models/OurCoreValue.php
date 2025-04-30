<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurCoreValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description1',
        'description2',
        'img',
        'icon1',
        'icon2',
    ];
    
}
