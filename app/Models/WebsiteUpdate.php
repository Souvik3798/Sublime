<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteUpdate extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'query'
    ];
}
