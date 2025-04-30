<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurContact extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading',
        'email',
        'phone',
        'email_icon',
        'phone_icon',
        'copyright',
    ];
}
