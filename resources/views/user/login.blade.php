@extends('layouts.main')
@section('title', 'Login')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Login Form</h1>

            <form action="{{ route('authinticate') }}" method="POST">
                @csrf
                <div class="mb-3">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                     id="email" placeholder="name@example.com" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ route('register') }}" class="ms-3 btn btn-link">Not registered?</a>
            </form>

        </div>
    </div>
@endsection