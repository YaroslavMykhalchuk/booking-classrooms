@extends('layouts.main')
@section('title', 'Welcome to Booking classrooms')
@section('content')
    <h1>Main Page</h1>

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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Booking classroom</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}">
            @csrf
            <div class="modal-body">
              <input type="hidden" name="room_id" id="room_id">
              <input type="hidden" name="day" id="day">
              <input type="hidden" name="pair" id="pair">
              <div class="mb-3">
                <label for="modal-group-name" class="form-label">Group name:</label>
                <input type="text" name="group_name" id="group-name" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete booking</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this booking?</p>
          </div>
          <div class="modal-footer">
            <form id="deleteForm" method="POST">
              @csrf
              @method('DELETE')
              <input type="hidden" name="id" id="booking_id">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger delete-booking-btn">Delete booking</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        document.addEventListener('DOMContentLoaded', function () {
          const buttons = document.querySelectorAll('.book-btn');

          buttons.forEach(button => {
            button.addEventListener('click', function () {
              document.getElementById('room_id').value = this.dataset.roomId;
              document.getElementById('day').value = this.dataset.day;
              document.getElementById('pair').value = this.dataset.pair;
              document.getElementById('group-name').value = '';
            });
          });
        });

        document.querySelectorAll('[data-bs-target="#deleteModal"]').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.bookingId;
                document.getElementById('booking_id').value = id;
            });
        });

        document.getElementById('deleteForm').addEventListener('submit', function (event) {
            const id = document.getElementById('booking_id').value;
            this.action = `/booking/${id}`;
        });
      });
    </script>
    
    <style>
      .schedule {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        text-align: fixed;
      }
      .schedule th,
      .schedule td {
        border: 1px solid #333;
        padding: 6px;
        text-align: center;
      }
      .schedule th {
        background: #eee;
      }
      /* Вертикальний текст для назв днів */
      .schedule .day {
        writing-mode: vertical-rl;
        text-orientation: upright;
        font-weight: bold;
        width: 2.5em;
        vertical-align: middle;
      }
      /* Товста лінія між днями */
      .schedule .separator td {
        border-top: 2px solid #333;
        padding: 0;
        height: 0;
      }
    </style>

@endsection