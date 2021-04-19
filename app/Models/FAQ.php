<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    protected $table = 'faq';

    protected $fillable = [
        'title',
        'description',
        'state',
        'district',
        'status',
        'author_id',
    ];

    public function author() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

}
