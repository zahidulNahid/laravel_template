<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Possible extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'logo',
        'description',
        'img',
    ];

}
