<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading',
        'title',
        'subtitle',
        'description',
        'button_name',
        'button_url',
        'back_img',
    ];
    
}
