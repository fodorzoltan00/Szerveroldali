<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Beadandó - Home</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Custom CSS for sticky footer -->
    <style>
        body, html {
            height: 100%;
        }

        .container-flex {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body>
<div class="container-flex">
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Laravel Beadandó</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Workers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Positions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Rooms</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Header Section -->
<header class="jumbotron text-center">
    <div class="container">
        <h1 class="display-4">Welcome to Laravel Beadandó</h1>
        <p class="lead">This is a sample homepage built with Laravel Blade.</p>
    </div>
</header>

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

<!-- Footer Section -->
<footer class="footer bg-light text-center py-3 mt-4">
    <div class="container">
        <p class="m-0">&copy; {{ date('Y') }} Cortea Levente</p>
    </div>
</footer>

<!-- Add Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
</body>
</html>
