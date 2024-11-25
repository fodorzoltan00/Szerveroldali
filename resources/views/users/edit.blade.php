@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                @if ($errors->has('name'))
                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="position_id">Position</label>
                <select name="position_id" id="position_id" class="form-control">
                    <option value="">Select Position</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ $position->id == $user->position_id ? 'selected' : '' }}>{{ $position->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('position_id'))
                    <div class="alert alert-danger">{{ $errors->first('position_id') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $user->phone_number }}">
                @if ($errors->has('phone_number'))
                    <div class="alert alert-danger">{{ $errors->first('phone_number') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
