@extends('layouts.main')
@section('title', 'Welcome to Booking classrooms')
@section('content')
    <h1>Головна сторінка</h1>

    <table class="schedule">
      <thead>
        <tr>
          <th></th><th></th>
          @foreach($rooms as $room)
            <th>{{ $room->name }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($days as $dayIndex => $dayName)
          @foreach($pairs as $pair)
            <tr>
              @if($loop->first)
                <td class="day" rowspan="{{ count($pairs) }}">{{ $dayName }}</td>
              @endif

              <td>{{ $pair }}</td>

              @foreach($rooms as $room)
                @php
                  $b = $schedule[$dayIndex][$pair][$room->id] ?? null;
                @endphp
                <td>
                  @if($b)
                    @if(auth()->check() && auth()->id() === $b->user_id)
                      <button type="button" 
                          class="btn btn-sm btn-outline w-100" 
                          data-bs-toggle="modal" 
                          data-bs-target="#deleteModal" 
                          data-booking-id="{{ $b->id }}">
                        <small class="text-success">✔ {{ $b->user->name }}</small><br>
                        <em>({{ $b->group_name }})</em>
                      </button>
                    @else
                      <div>
                        <small class="text-success">✔ {{ $b->user->name }}</small><br>
                        <em>({{ $b->group_name }})</em>
                      </div>
                    @endif
                  @else
                    @auth
                      @if(auth()->user()->isConfirmed())
                        <button class="btn btn-sm btn-outline-primary book-btn w-100"
                          type="button"
                          data-bs-toggle="modal" 
                          data-bs-target="#bookingModal"
                          data-room-id="{{ $room->id }}"
                          data-day="{{ $dayIndex }}"
                          data-pair="{{ $pair }}">
                          Вільно
                        </button>
                      @endif
                    @endauth
                  @endif
                </td>
              @endforeach
            </tr>
          @endforeach
          <tr class="separator">
            <td colspan="{{ 2 + $rooms->count() }}"></td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Create booking modal --}}
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Бронювання аудиторій</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}">
            @csrf
            <div class="modal-body">
              <input type="hidden" name="room_id" id="room_id">
              <input type="hidden" name="day" id="day">
              <input type="hidden" name="pair" id="pair">
              <div class="mb-3">
                <label for="modal-group-name" class="form-label">Назва групи:</label>
                <input type="text" name="group_name" id="group-name" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
              <button type="submit" class="btn btn-primary">Зберегти</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    {{-- Delete booking modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Видалити бронювання</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Ви впевнені, що хочете видалити бронювання?</p>
          </div>
          <div class="modal-footer">
            <form id="deleteForm" method="POST">
              @csrf
              @method('DELETE')
              <input type="hidden" name="id" id="booking_id">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
              <button type="submit" class="btn btn-danger delete-booking-btn">Видалити бронювання</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection