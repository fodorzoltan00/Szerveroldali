@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $position->name }} Users</h1>

        @if ($users->isEmpty())
            <p>No Users in this position</p>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone number</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to the previous page</a>
    </div>
@endsection
