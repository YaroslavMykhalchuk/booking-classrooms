<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Booking;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::select('id', 'name')->get();
        // dd($rooms);

        return view('rooms.index', compact('rooms'));
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
            'name' => ['required', 'string', 'max:255', 'unique:rooms'],
        ]);

        Room::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.rooms')->with('success', 'Аудиторія успішно додана!');
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
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:rooms,id',
            'name' => ['required', 'string', 'max:255', 'unique:rooms,name,' . $request->id],
        ]);

        $room = Room::findOrFail($request->id);
        $room->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.rooms')->with('success', 'Аудиторія успішно оновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:rooms,id',
        ]);

        $room = Room::findOrFail($request->id);
        $room->delete();

        return redirect()->route('admin.rooms')->with('success', 'Аудиторія успішно видалена!');
    }

    public function maintenance(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'day' => 'required|integer|between:1,5',
            'group_name' => 'required|string|max:255',
        ]);

        $pairNumbers = range(1, 6);
        if ($request->room_id == 0) {
            $roomIds = Room::pluck('id');
        } else {
            $roomIds = collect([$request->room_id]);
        }

        foreach ($roomIds as $roomId) {
            foreach ($pairNumbers as $pair) {
                Booking::updateOrCreate([
                    'room_id' => $roomId,
                    'day_week' => $request->day,
                    'pair_number' => $pair,
                    'group_name' => $request->group_name,
                    'user_id' => auth()->id(),
                ]);
            }
        }

        return redirect()->route('admin.rooms')->with('success', 'Обслуговування аудиторій заплановано!');
    }
}
