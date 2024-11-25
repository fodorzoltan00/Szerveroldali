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
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')->with('success', 'Pozíció sikeresen létrehozva');
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')->with('success', 'Pozíció sikeresen frissítve');
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Pozíció sikeresen törölve');
    }

    public function users(Position $position)
    {
        $users = $position->users();
        return view('positions.users', compact('users', 'position'));
    }
}
