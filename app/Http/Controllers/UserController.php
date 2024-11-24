<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // A felhasználók lekérése és a kapcsolódó pozíciók betöltése
        $Users = User::with('position')->paginate(10);
        return view('users', compact('Users'));
    }

    public function show(User $user)
    {
        // A felhasználó és a kapcsolódó pozíciójának betöltése azonosító alapján
        $user->load('position');
        return view('users.show', compact('user'));
    }
}
