<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\UserRoomEntry;
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
        $data = $request->validate([
            'name' => 'required|string|min:5|max:255|unique:rooms,name',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position_ids' => 'array|exists:positions,id'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $room = Room::create($data);
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

    public function accessRoom(Request $request, Room $room)
    {
        $success = $this->checkRoomAccess($request->user(), $room);

        UserRoomEntry::create([
            'user_id' => $request->user()->id,
            'room_id' => $room->id,
            'status' => $success ? 'successful' : 'failed',
        ]);

        return redirect()->route('rooms.show', $room->id)
            ->with('status', $success ? 'Successful entry!' : 'Access denied!');
    }

    protected function checkRoomAccess($user, $room)
    {
        return $room->positions->contains($user->position);
    }

    public function roomHistory(Room $room)
    {
        $entries = UserRoomEntry::with(['user', 'room'])
            ->where('room_id', $room->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('rooms.history', compact('entries', 'room'));
    }
}
