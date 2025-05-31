@extends('layouts.dashboard')
@section('title', 'Welcome to dashboard')
@section('content')
    <h1 class="mb-4">Список користувачів</h1>
    <p class="lead">Тут ви можете переглядати, змінювати дані користувачів.</p>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Прізвище</th>
                <th scope="col">Email</th>
                <th scope="col" class="text-end me-4">Роль</th>
                <th scope="col" class="text-end me-4">Підтверджений</th>
                <th scope="col" class="text-end me-4">Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-end">{{ $user->role }}</td>
                    <td class="text-end">
                        @if ($user->isConfirmed)
                            <span class="badge bg-success">Так</span>
                        @else
                            <span class="badge bg-secondary">Ні</span>
                        @endif
                    <td class="text-end">
                        <a href="#" class="btn btn-warning btn-sm">Редагувати</a>
                        <form action="#" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection