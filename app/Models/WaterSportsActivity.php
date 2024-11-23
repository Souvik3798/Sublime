<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterSportsActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'adult_price',
        'child_5_12_price',
        'child_2_5_price',
        'infant_price',
        'user_id',
    ];
}
