@extends('layouts.main')

@section('title', 'Реєстрація')

@section('content')

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Форма реєстрації</h1>

            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Прізвище</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                     id="name" placeholder="Прізвище" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
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
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Підтвердити пароль</label>
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                </div>

                <button type="submit" class="btn btn-primary">Реєстрація</button>
                <a href="{{ route('login') }}" class="ms-3 btn btn-link">Вже зареєстровані?</a>
            </form>

        </div>
    </div>
@endsection