<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('positions')->paginate(10);
        return view('room', compact('rooms'));
    }

    public function create()
    {
        if (!Gate::allows('manage-rooms')) {
            abort(403);
        }

        return view('rooms.create');
    }


    //public function store(Request request){}

    public function show($id)
    {
        // Kód a belépések megtekintéséhez

    }

    public function edit($id)
    {
        if (!Gate::allows('manage-rooms')) {
            abort(403);
        }

        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        // Kód a szoba frissítéséhez

    }

    public function destroy($id)
    {
        // Kód a szoba törléséhez

    }
}
