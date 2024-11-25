<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Position;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('positions')->paginate(10);
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $positions = Position::all();
        return view('rooms.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position_ids' => 'array|exists:positions,id'
        ]);

        $room = Room::create($request->only('name'));
        $room->positions()->sync($request->position_ids);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        $positions = Position::all();
        return view('rooms.edit', compact('room', 'positions'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position_ids' => 'array|exists:positions,id'
        ]);

        $room->update($request->only('name'));
        $room->positions()->sync($request->position_ids);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }

    public function access(Room $room)
    {
        // Implementáljuk a hozzáférések megtekintését
        return view('rooms.access', compact('room'));
    }
}
