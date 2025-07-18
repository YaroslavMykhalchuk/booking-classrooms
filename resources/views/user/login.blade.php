@extends('layouts.main')
@section('title', 'Вхід до системи')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Форма входу</h1>

            <form action="{{ route('authinticate') }}" method="POST">
                @csrf
                <div class="mb-3">
                <div class="mb-3">
                    <label for="email" class="form-label">Пошта</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                     id="email" placeholder="name@example.com" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Вхід</button>
                <a href="{{ route('register') }}" class="ms-3 btn btn-link">Ще не зареєстровані?</a>
            </form>
            
        </div>
        <a href="{{ route('password.request') }}" class="ms-0 px-0 btn btn-link">Забули пароль?</a>
    </div>
@endsection