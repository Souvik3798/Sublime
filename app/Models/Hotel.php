<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotels';

    protected $fillable = ['hotelName', 'hotel_category_id', 'destination_id', 'user_id'];

    public function hotel_category(): BelongsTo
    {
        return $this->belongsTo(HotelCategory::class);
    }

    public function destination(): HasOne
    {
        return $this->hasOne(destination::class);
    }

    public function room_category(): HasMany
    {
        return $this->hasMany(RoomCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
