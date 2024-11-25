@extends('layouts.app')

@section('content')
<!-- Main Section -->
    <div class="container">
        <h1>Users</h1>
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
                        <div>{{ $user->position->name }}</div>
                    </td>
                    <td>
                        <div>{{ $user->phone_number }}</div>
                    </td>
                    <td>
                        <!-- Add action buttons as needed -->
                        <!-- Example: Edit User -->
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
</main>
@endsection
