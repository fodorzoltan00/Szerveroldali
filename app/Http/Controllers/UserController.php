<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Position;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('position')->get(); // Eager loading 'position' relationship
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $positions = Position::all();
        return view('users.create', compact('positions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'position_id' => 'nullable|exists:positions,id',
            'phone_number' => 'nullable|string|max:255',
            'card_number' => [
                'nullable',
                'string',
                'size:16',
                'regex:/^[0-9a-zA-Z]{16}$/'
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'position_id' => $request->position_id,
            'phone_number' => $request->phone_number,
            'card_number' => $request->card_number,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    public function show(User $user)
    {
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'position_id' => 'nullable|exists:positions,id',
            'phone_number' => 'nullable|string',
            'card_number' => [
                'nullable',
                'string',
                'size:16',
                'regex:/^[0-9a-zA-Z]{16}$/'
            ],
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
