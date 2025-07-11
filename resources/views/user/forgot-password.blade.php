@extends('layouts.main')
@section('title', 'Забули пароль')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Забули пароль?</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Електронна пошта</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Надіслати посилання для скидання</button>
        </form>
    </div>
@endsection