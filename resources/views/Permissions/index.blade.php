@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My permissions</h1>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Position</h5>
                <p class="card-text">{{ $position->name }}</p>
            </div>
        </div>

        <h2>Can access the following rooms</h2>

        @if ($rooms->isEmpty())
            <p>You can't access any rooms</p>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Room name</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td><img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" style="width: 100px;"></td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Back to the previous page</a>
    </div>
@endsection
