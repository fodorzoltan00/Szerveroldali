@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Új Pozíció</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Position Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>
@endsection
