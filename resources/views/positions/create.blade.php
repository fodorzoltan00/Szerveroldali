@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Position</h1>
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Position Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger">
                    {{ $errors->first('name') }}
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
