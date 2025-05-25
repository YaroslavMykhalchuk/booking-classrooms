@extends('layouts.dashboard')
@section('title', 'Welcome to dashboard')
@section('content')
    <h1 class="mb-4">Список аудиторій</h1>
    <p class="lead">Тут ви можете переглядати, додавати, змінювати та видаляти аудиторії для бронювання.</p>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRoomModal">
        Додати аудиторію
    </button>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Номер аудиторії</th>
                <th scope="col" class="text-end me-4">Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <th scope="row">{{ $room->id }}</th>
                    <td>{{ $room->name }}</td>
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
    </table>
@endsection