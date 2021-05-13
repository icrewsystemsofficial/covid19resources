<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappAuthentication extends Model
{
    use HasFactory;

    protected $fillables = [
        'phone',
        'token',
        'user_id',
    ];

}
