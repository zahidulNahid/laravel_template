<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoweredByMrPc extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'img',
        'logo',
    ];
}
