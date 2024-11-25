@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Room</h1>
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Room Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="position_ids">Allowed Positions</label>
                <select multiple name="position_ids[]" id="position_ids" class="form-control">
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('position_ids'))
                    <div class="alert alert-danger">{{ $errors->first('position_ids') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
