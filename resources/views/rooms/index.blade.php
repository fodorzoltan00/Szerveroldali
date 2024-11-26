@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Rooms</h1>

        @if (auth()->user()->admin)
            <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Create new room</a>
        @endif

        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>Room name</th>
                <th>Allowed positions</th>
                @if (auth()->user()->admin)
                    <th>Options</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->name }}</td>
                    <td>
                        @if ($room->positions->isEmpty())
                            <span>N/A</span>
                        @else
                            @foreach ($room->positions as $position)
                                <div>{{ $position->name }}</div>
                            @endforeach
                        @endif
                    </td>
                    @if (auth()->user()->admin)
                        <td>
                            <a href="{{ route('rooms.history', $room->id) }}" class="btn btn-info">Entry history</a>
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
