<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IternityTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'Title',
        'Description',
        'Specialties',
        'locationCovered',
        'user_id',
        'Longdescription'
    ];

    protected $casts = [
        'Specialties' => 'array',
        'locationCovered' => 'array',
        'Longdescription' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
