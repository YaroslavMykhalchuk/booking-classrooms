@extends('layouts.dashboard')
@section('title', 'Ласкаво просимо до панелі адміністратора')
@section('content')
    <h1 class="mb-4">Список аудиторій</h1>
    <p class="lead">Тут ви можете переглядати, додавати, змінювати та видаляти аудиторії для бронювання.</p>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRoomModal">
        Додати аудиторію
    </button>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#maintenanceRoomModal">
        Обслуговування аудиторій
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
                        <button type="button" 
                            class="btn btn-warning btn-sm edit-room-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editRoomModal"
                            data-room-id="{{ $room->id }}"
                            data-room-name="{{ $room->name }}">
                            Редагувати
                        </button>
                        <button type="button" 
                            class="btn btn-danger btn-sm" 
                            id="delete-room-btn"
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteRoomModal"
                            data-room-id="{{ $room->id }}">
                            Видалити
                        </button>

                    </td>
                </tr>
            @endforeach
    </table>

    {{-- Add room modal --}}
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.rooms.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Додати аудиторію</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Вкажіть номер аудиторії:</label>
                        <input type="text" name="name" class="form-control" placeholder="Номер аудиторії" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <button type="submit" class="btn btn-primary">Створити</button>
                </div>
            </form>
        </div>
    </div>


    {{-- Edit room modal --}}
    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.rooms.update') }}" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editRoomLabel">Редагувати дані про аудиторію</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="id" id="edit-room-id">
                        <label for="edit-room-name" class="form-label">Вкажіть змінений номер аудиторії:</label>
                        <input type="text" name="name" id="edit-room-name" class="form-control" placeholder="Номер аудиторії" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <button type="submit" class="btn btn-primary">Зберегти зміни</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete room modal --}}
    <div class="modal fade" id="deleteRoomModal" tabindex="-1" aria-labelledby="deleteRoomLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteRoomLabel">Видалити аудиторію</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ви впевнені, що хочете видалити цю аудиторію?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <form action="{{ route('admin.rooms.destroy') }}" method="POST" id="delete-room-form">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" id="delete-room-id">
                        <button type="submit" class="btn btn-danger">Видалити</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Maintenance room modal --}}
    <div class="modal fade" id="maintenanceRoomModal" tabindex="-1" aria-labelledby="maintenanceRoomLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.rooms.maintenance') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="maintenanceRoomLabel">Обслуговування аудиторій</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="maintenance-room-select" class="form-label">Вкажіть номер аудиторії для обслуговування:</label>
                        <select name="room_id" id="maintenance-room-select" class="form-select mb-3">
                            <option value="" selected disabled>Оберіть аудиторію</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                            <option value="0">Всі аудиторії</option>
                        </select>
                        <label for="maintenance-day" class="form-label">Вкажіть день обслуговування:</label>
                        <select name="day" id="maintenance-day" class="form-select mb-3">
                            <option value="" selected disabled>Оберіть день</option>
                            <option value="1">Понеділок</option>
                            <option value="2">Вівторок</option>
                            <option value="3">Середа</option>
                            <option value="4">Четвер</option>
                            <option value="5">Пʼятниця</option>
                        </select>
                        <label for="maintenance-description" class="form-label">Вкажіть причину обслуговування:</label>
                        <input type="text" name="group_name" id="maintenance-description" class="form-control" placeholder="Причина обслуговування" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <button type="submit" class="btn btn-primary">Почати обслуговування</button>
                </div>
            </form>
        </div>
    </div>
@endsection