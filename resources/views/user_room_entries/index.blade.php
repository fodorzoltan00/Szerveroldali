@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Room Entries</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Room Name</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($entries as $entry)
                <tr>
                    <td>{{ $entry->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ optional($entry->room)->name ?? 'Unknown Room' }}</td>
                    <td>{{ $entry->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No entries found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $entries->links() }}
        </div>
    </div>
@endsection
