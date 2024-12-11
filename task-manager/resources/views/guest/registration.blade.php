@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Register</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
