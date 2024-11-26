@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My room entry history</h1>

        @if ($entries->isEmpty())
            <p>No entries</p>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Room</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($entries as $entry)
                    <tr>
                        <td>{{ $entry->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $entry->room->name }}</td>
                        <td>{{$entry->successful ? 'Room entry successful' : 'Room entry denied' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $entries->links() }}
            </div>
        @endif

        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
