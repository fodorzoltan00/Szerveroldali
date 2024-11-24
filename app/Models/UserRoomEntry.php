<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class UserRoomEntry extends Model
{
    /** @use HasFactory<\Database\Factories\UserRoomEntryFactory> */
    use HasFactory;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userRoomEntry) {
            $hasAccess = DB::table('position_room')
                ->where('position_id', $userRoomEntry->user->position_id)
                ->where('room_id', $userRoomEntry->room_id)
                ->exists();

            $userRoomEntry->successful = $hasAccess;
        });
    }

}
