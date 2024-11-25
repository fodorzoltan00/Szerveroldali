
@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="container">
            <h1>Pozíciók</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (auth()->user()->admin)
                <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">Új pozíció létrehozása</a>
            @endif

            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>Név</th>
                    <th>Felhasználók száma</th>
                    <th>Szobák</th>
                    @if (auth()->user()->admin)
                        <th>Műveletek</th>
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
                                <span class="badge badge-info">{{ $room->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('positions.users', $position->id) }}" class="btn btn-info">Felhasználók megtekintése</a>
                            @if (auth()->user()->admin)
                                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning">Szerkesztés</a>
                                <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Törlés</button>
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

<!-- Add Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
</body>
</html>
