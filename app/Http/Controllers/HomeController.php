<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $roomCount = Room::count();

    return view('homepage', compact('userCount', 'roomCount'));
    }
}
