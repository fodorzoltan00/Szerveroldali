@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>

        @if (auth()->user()->admin)
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add new user</a>
        @endif

        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="table">
                    <td>
                        <span>{{ $user->name }}</span>
                    </td>
                    <td>
                        @if ($user->position)
                            <div>{{ $user->position->name }}</div>
                        @else
                            <div>No Position</div>
                        @endif
                    </td>
                    <td>
                        <div>{{ $user->phone_number }}</div>
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
