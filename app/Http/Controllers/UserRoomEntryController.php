<?php

namespace App\Http\Controllers;

use App\Models\UserRoomEntry;
use Illuminate\Http\Request;

class UserRoomEntryController extends Controller
{
    public function index()
    {
        $entries = UserRoomEntry::with(['user', 'room'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user_room_entries.index', compact('entries'));
    }
}
