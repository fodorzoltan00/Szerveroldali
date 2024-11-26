@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Room History: {{ $room->name }}</h1>



        @if ($entries->isEmpty())
            <p>No entries found.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>User Name</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($entries as $entry)
                    <tr>
                        <td>{{ $entry->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $entry->user ? $entry->user->name : 'Unknown User' }}</td>
                        <td>{{ $entry->status }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $entries->links() }}
            </div>
        @endif

        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Back to the rooms</a>
    </div>
@endsection
