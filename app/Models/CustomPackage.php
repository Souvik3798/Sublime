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
        'place',
        'fee',
        'addons',
        'voucher',
        'margin',
        'user_id'
    ];

    protected $casts = [
        'inclusions' => 'array',
        'exclusions' => 'array',
        'itinerary' => 'array',
        'rooms' => 'array',
        'cruz' => 'array',
        'vehicle' => 'array',
        'addons' => 'array',
        'place' => 'array'
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
}
