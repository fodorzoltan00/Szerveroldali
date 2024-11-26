@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @if ($errors->has('name'))
                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @if ($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Password (leave empty to keep current password)</label>
                <input type="password" name="password" id="password" class="form-control">
                @if ($errors->has('password'))
                    <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <div class="form-group">
                <label for="position_id">Position</label>
                <select name="position_id" id="position_id" class="form-control">
                    <option value="">Select Position</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ old('position_id', $user->position_id) == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('position_id'))
                    <div class="alert alert-danger">{{ $errors->first('position_id') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                @if ($errors->has('phone_number'))
                    <div class="alert alert-danger">{{ $errors->first('phone_number') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" name="card_number" id="card_number" class="form-control" value="{{ old('card_number', $user->card_number) }}">
                @if ($errors->has('card_number'))
                    <div class="alert alert-danger">{{ $errors->first('card_number') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
