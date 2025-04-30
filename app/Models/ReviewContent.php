<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'back_img',
    ];
}
