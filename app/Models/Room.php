<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'image'];

    public function userRoomEntries()
    {
        return $this->hasMany(UserRoomEntry::class);
    }

    public function positions(){
        return $this->belongsToMany(Position::class);
    }
}
