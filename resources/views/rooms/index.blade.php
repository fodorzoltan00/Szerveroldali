@extends('layouts.app')

@section('content')
<!-- Main Section -->
    <div class="container">
        <h1>Szobák</h1>

        @if (auth()->user()->admin)
            <div class="alert alert-success">Admin user</div>
        @else
            <div class="alert alert-danger">Not an admin user</div>
        @endif

        @if (auth()->user()->admin)
            <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Új szoba létrehozása</a>
        @endif

        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>Név</th>
                <th>Jogosult munkakörök</th>
                @if (auth()->user()->admin)
                    <th>Műveletek</th>
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
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Szerkesztés</a>
                            <a href="{{ route('rooms.access', $room->id) }}" class="btn btn-info">Belépés napló</a>

                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Törlés</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
