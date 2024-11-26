@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $room->name }}</h1>

        @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('rooms.access', $room->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Belépés</button>
        </form>
    </div>
@endsection
