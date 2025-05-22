<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::orderBy('name')->get();

        $bookings = Booking::where('status', 'active')->get();

        $schedule = [];
        foreach ($bookings as $b) {
            $schedule[$b->day_week][$b->pair_number][$b->room_id] = $b;
        }

        $days  = [
            1 => 'Понеділок',
            2 => 'Вівторок',
            3 => 'Середа',
            4 => 'Четвер',
            5 => 'П’ятниця',
        ];
        $pairs = range(1, 6);

        return view('welcome', compact('rooms','days','pairs','schedule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'day'     => 'required|integer|min:1|max:5',
            'pair'    => 'required|integer|min:1|max:6',
            'group_name' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        if (!$user || !$user->isConfirmed()) {
            return redirect()->back()->with('error', 'Ви не підтверджені для бронювання.');
        }

        $existing = Booking::where('room_id', $request->room_id)
            ->where('day_week', $request->day)
            ->where('pair_number', $request->pair)
            ->where('status', 'active')
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Ця пара вже заброньована.');
        }

        Booking::create([
            'room_id'     => $request->room_id,
            'user_id'     => $user->id,
            'day_week'    => $request->day,
            'pair_number' => $request->pair,
            'group_name'  => $request->group_name,
            'status'      => 'active',
        ]);

        return redirect()->route('home')->with('success', 'Бронювання успішно створене.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $booking = Booking::findOrFail($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Бронювання не знайдено.');
        }

        if ($booking->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Ви не можете видалити це бронювання.');
        }

        $booking->delete();

        return redirect()->route('home')->with('success', 'Бронювання успішно видалене.');
    }
}
