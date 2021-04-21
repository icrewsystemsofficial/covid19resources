<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'body',
        'phone',
        'url',
        'author_id',
        'verified',
        'verified_by',
    ];

    public function category_data() {
        return $this->hasOne(Category::class, 'id', 'category');
    }

    public function author_data() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function verified_by_data() {
        return $this->hasOne(User::class, 'id', 'verified_by');
    }

}
