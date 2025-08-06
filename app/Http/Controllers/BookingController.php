<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBookings = Booking::all();
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
        $data = $request->toArray();
        $data['user_id'] = $request->user_id;

        if (isset($data['started_at'])) {
            $startDate = Carbon::parse($data['started_at']);
            $data['started_at'] = $startDate->setTime(17, 0, 0);
        }
        
        if (isset($data['finished_at'])) {
            $endDate = Carbon::parse($data['finished_at']);
            $data['finished_at'] = $endDate->setTime(12, 0, 0);
        }

        $roomId = $data['room_id'] ?? null;
        if ($roomId && isset($data['started_at'], $data['finished_at'])) {
            $start = Carbon::parse($data['started_at']);
            $end = Carbon::parse($data['finished_at']);

            $overlap = Booking::where('room_id', $roomId)
                ->where(function ($query) use ($start, $end) {
                    $query->where(function ($q) use ($start) {
                        $q->where('started_at', '>', $start)->where('finished_at', '<', $start);
                    })
                    ->orWhere(function ($q) use ($end) {
                        $q->where('started_at', '>', $end)->where('finished_at', '<', $end);
                    });
                })
                ->exists();

            if ($overlap) {
                return back()->withErrors(['booking' => 'Невозможно забронировать этот номер в выбранные даты.']);
            }
        }

        $startDate = Carbon::parse(request()->get('start_date', Carbon::now()->format('Y-m-d')));
        $endDate = Carbon::parse(request()->get('end_date', Carbon::now()->addDay()->format('Y-m-d')));
        $countNight = $startDate->diffInDays($endDate);
        $price = Room::where('id', $request->room_id)->value('price');
        $data['price'] = $price * $countNight;

        Booking::create($data);
        return redirect()->route('b.index');
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
