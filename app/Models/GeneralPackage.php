<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeneralPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'days',
        'nights',
        'name',
        'description',
        'cost',
        'image',
        'inclusions',
        'exclusions',
        'iternity', 'user_id'
    ];

    protected $casts = [
        'inclusions' => 'array',
        'exclusions' => 'array',
        'iternity' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
