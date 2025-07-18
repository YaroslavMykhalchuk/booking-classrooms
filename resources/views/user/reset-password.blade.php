@extends('layouts.main')
@section('title', 'Відновлення паролю')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Скидання пароля</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="form-label">Електронна пошта</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Новий пароль</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"name="password" required>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Підтвердження пароля</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-success">Скинути пароль</button>
        </form>
    </div>
@endsection