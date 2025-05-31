@extends('layouts.dashboard')
@section('title', 'Welcome to dashboard')
@section('content')
    <h1 class="mb-4">Ласкаво просимо до адмін панелі.</h1>
    <p class="lead">Тут ви можете керувати та змінювати дані системи.</p>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 h-100">
                <div class="card-body">
                    <h5 class="card-title">Керувати аудиторіями</h5>
                    <p class="card-text">Додати, змінити, чи видалити аудиторії для бронювання.</p>  
                    <a href="{{ route('admin.rooms') }}" class="btn btn-primary">Керувати аудиторіями</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 h-100">
                <div class="card-body">
                    <h5 class="card-title">Керувати користувачами</h5>
                    <p class="card-text">Додати, змінити, чи видалити користувача.</p>  
                    <a href="{{ route('admin.users') }}" class="btn btn-primary">Керувати користувачами</a>
                </div>
            </div>
        </div>
    </div>
@endsection