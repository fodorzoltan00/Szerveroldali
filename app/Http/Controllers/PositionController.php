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
            'required|string|max:255|unique:positions,name',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')->with('success', 'Position created successfully.');
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'required|string|max:255|unique:positions,name',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')->with('success', 'Position updated successfully.');
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Position deleted successfully');
    }

    public function users(Position $position)
    {
        $users = $position->users()->get();

        return view('positions.users', compact('position', 'users'));
    }
}
