<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBookings = Booking::where('user_id', Auth::id())->get();
        return view('bookings.index', ['bookings' => $allBookings]);
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
        $validated = $request->validate([
            'room_id'     => 'required|exists:rooms,id',
            'started_at'  => 'required|date',
            'finished_at' => 'required|date|after:started_at',
        ]);

        $start = Carbon::parse($validated['started_at'])->setTime(17, 0, 0);
        $end   = Carbon::parse($validated['finished_at'])->setTime(12, 0, 0);

        $overlap = Booking::where('room_id', $validated['room_id'])
            ->where('started_at', '<', $end)
            ->where('finished_at', '>', $start)
            ->exists();

        if ($overlap) {
            return back()->withErrors([
                'booking' => 'Невозможно забронировать этот номер в выбранные даты.'
            ])->withInput();
        }

        $countNight = $start->diffInDays($end);
        $pricePerNight = Room::where('id', $validated['room_id'])->value('price');
        $totalPrice = $pricePerNight * $countNight;

        Booking::create([
            'room_id'     => $validated['room_id'],
            'user_id'     => $request->user()->id,
            'started_at'  => $start,
            'finished_at' => $end,
            'price'       => $totalPrice,
            'days'        => $countNight,
        ]);

        return redirect()->route('b.index')->with('success', 'Бронирование успешно создано.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookingData = Booking::FindOrFail($id);
        return view('bookings.show', ['booking' => $bookingData]);
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
    public function destroy(string $id)
    {
        Booking::destroy($id);
        return redirect()->back();
    }
}
