<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'back_img',
        'itemname1',
        'itemlink1',
        'itemname2',
        'itemlink2',
        'itemname3',
        'itemlink3',
        'itemname4',
        'itemlink4',
    ];
}
