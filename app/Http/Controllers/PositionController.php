<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::with(['rooms'])->withCount('users')->get();
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        if (!Gate::allows('manage-positions')) {
            abort(403);
        }

        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Position::create([
            'name' => $request->name,
        ]);

        return redirect()->route('positions.index')->with('success', 'Position created successfully.');
    }

    public function edit(Position $position)
    {
        if (!Gate::allows('manage-positions')) {
            abort(403);
        }

        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        if (!Gate::allows('manage-positions')) {
            abort(403);
        }

        // Validáció és adatfrissítés
    }

    public function destroy(Position $position)
    {
        if (!Gate::allows('manage-positions')) {
            abort(403);
        }

        // Munkakör törlése
    }

    public function users(Position $position)
    {
        $users = $position->users();
        return view('positions.users', compact('users', 'position'));
    }
}
