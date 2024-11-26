
@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="container">
            <h1>Positions</h1>

            @if (auth()->user()->admin)
                <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">Create new position</a>
            @endif

            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>Position name</th>
                    <th>Usercount</th>
                    <th>Can access the following rooms</th>
                    @if (auth()->user()->admin)
                        <th>Options</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach ($positions as $position)
                    <tr>
                        <td>{{ $position->name }}</td>
                        <td>{{ $position->users_count }}</td>
                        <td>
                            @foreach ($position->rooms as $room)
                                <span class="badge badge-info" style="color: black">{{ $room->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('positions.users', $position->id) }}" class="btn btn-info">Display Users</a>
                            @if (auth()->user()->admin)
                                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </main>
@endsection

