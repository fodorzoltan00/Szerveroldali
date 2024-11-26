<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PermissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $position = $user->position;

        $rooms = $position->rooms()->with('positions')->get();

        return view('permissions.index', compact('position', 'rooms'));
    }
}
