<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('position')->get(); // Eager loading 'position' relationship
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        // A felhasználó és a kapcsolódó pozíciójának betöltése azonosító alapján
        $user->load('position');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $positions = \App\Models\Position::all(); // Feltételezve, hogy van Position modell
        return view('users.edit', compact('user', 'positions'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position_id' => 'nullable|exists:positions,id',
            'phone_number' => 'nullable|string|max:255',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
