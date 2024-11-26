<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRoomEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoomEntryController extends Controller
{
    public function index()
    {
        $entries = UserRoomEntry::with(['user', 'room'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user_room_entries.index', compact('entries'));
    }

    public function history(User $user)
    {
        $entries = $user->userRoomEntries()->with('room')->orderBy('created_at', 'desc')->paginate(10);

        return view('users.room-entries', compact('user', 'entries'));
    }

    public function myEntries()
    {
        $user = Auth::user();

        $entries = $user->userRoomEntries()->with('room')->orderBy('created_at', 'desc')->paginate(10);

        return view('users.my-room-entries', compact('entries'));
    }
}
