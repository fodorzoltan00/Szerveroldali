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
<main class="container">
    @section('content')
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
