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
                        <button class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editUserModal"
                            data-user-id="{{ $user->id }}"
                            data-user-name="{{ $user->name }}">
                            Редагувати
                        </button>
                        <button type="button" 
                            class="btn btn-danger btn-sm" 
                            id="delete-user-btn"
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteUserModal"
                            data-user-id="{{ $user->id }}">
                            Видалити
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Edit user modal --}}
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.users.update') }}" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUserLabel">Редагувати дані користувача</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="id" id="edit-user-id">
                        <label for="edit-user-name" class="form-label">Вкажіть нове ім'я користувача:</label>
                        <input type="text" name="name" id="edit-user-name" class="form-control" placeholder="Ім'я користувача" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <button type="submit" class="btn btn-primary">Зберегти зміни</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete user modal --}}
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteUserLabel">Видалити користувача</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ви впевнені, що хочете видалити цього користувача?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <form action="{{ route('admin.users.destroy') }}" method="POST" id="delete-user-form">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" id="delete-user-id">
                        <button type="submit" class="btn btn-danger">Видалити</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection