<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category', 'user_id'
    ];

    public function hotel(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
