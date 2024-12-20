<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'customers_id',
        'cid',
        'category_id',
        'days',
        'nights',
        'name',
        'description',
        'inclusions',
        'exclusions',
        'itinerary',
        'rooms',
        'cruz',
        'vehicle',
        'luggage',
        'place',
        'fee',
        'addons',
        'price',
        'voucher',
        'margin',
        'user_id',
        'water_sports',
    ];

    protected $casts = [
        'inclusions' => 'array',
        'exclusions' => 'array',
        'itinerary' => 'array',
        'rooms' => 'array',
        'cruz' => 'array',
        'vehicle' => 'array',
        'addons' => 'array',
        'place' => 'array',
        'water_sports' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(destination::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addon(): BelongsTo
    {
        return $this->belongsTo(Addon::class);
    }
}
