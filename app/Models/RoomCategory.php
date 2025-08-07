<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category', 'cp', 'ap', 'map', 'cp_seasonal', 'ap_seasonal', 'map_seasonal', 'hotel_id', 'user_id'];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
