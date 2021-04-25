<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;
    protected $attributes = [
        'capital' => 'unknown',
        'code' => 'unknown',
    ];

    public function totalCities() {
        return City::where('state', 'LIKE', '%' . $this->name . '%')->count();

    }
}
