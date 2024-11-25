
@extends('layouts.app')

@section('head')
    <title>Laravel Beadandó - Home</title>
@endsection

@section('content')

<header class="jumbotron text-center">
    <div class="container">
        <h1 class="display-4">Welcome to Laravel Beadandó</h1>
        <p class="lead">This is a sample homepage built with Laravel Blade.</p>
    </div>
</header>

<main class="container">
    <div class="row text-center">
        <div class="col-md-6">
            <h4>Number of workers in the system</h4>
            <h2><strong>{{ $userCount }}</strong></h2>
        </div>
        <div class="col-md-6">
            <h3>Number of rooms in the system</h3>
            <h2><strong>{{ $roomCount }}</strong></h2>
        </div>
    </div>
</main>
@endsection

