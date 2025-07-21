<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomsData = Room::all();
        return view('components.hotels.hotel-card', ['rooms' => $roomsData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::all();
        return view('hotels.add_room_form', ['hotels' => $hotels]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'area' => 'nullable|numeric|min:0',
            'room_class' => 'nullable|string|max:50',
            'hotel_id' => 'required|exists:hotels,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('room_images', 'public');
        }

        Room::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'poster_url' => $imagePath,
            'floor_area' => $validated['area'] ?? null,
            'type' => $validated['room_class'] ?? null,
            'price' => $validated['price_per_night'],
            'hotel_id' => $validated['hotel_id'],
        ]);

        return redirect()->route('h.list')->with('success', 'Комната успешно добавлена.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roomData = Room::findOrFail($id)->toArray();
        return view('', ['data' => $roomData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoomRequest $request, $id)
    {
        $path = null;

        if ($request->hasFile('poster_url')) {
            $path = $request->file('poster_url')->store('room_images', 'public');
        }

        $validatedData = $request->toArray();
        $validatedData['poster_url'] = $path;
        Room::findOrFail($id)->update($validatedData);
        dd('В контроллере комнат в метод update, на строке 67, надо вставить название роута куда перенаправляем');
        return redirect()->route('');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Room::destroy($id);
    }
}
