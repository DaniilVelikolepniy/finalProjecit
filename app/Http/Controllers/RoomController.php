<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('rooms.add_room_form', ['hotels' => $hotels]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|min:0',
            'area' => 'nullable|min:0',
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

        return redirect()->route('h.show', ['hotel' => $request->hotel_id]);
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
        $hotels = Hotel::all();
        return view('rooms.edit_room_form', ['data' => $roomData, 'hotels' => $hotels]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoomRequest $request, $id)
    {
        $room = Room::findOrFail($id);
        $path = $room->poster_url;

        if ($request->hasFile('poster_url')) {
            $file = $request->file('poster_url');

            if ($file->isValid() && str_starts_with($file->getMimeType(), 'image/')) {
                if ($room->poster_url) {
                    Storage::disk('public')->delete($room->poster_url);
                }

                $path = $file->store('room_images', 'public');
            } else {
                return redirect()->back()->withErrors(['poster_url' => 'Файл должен быть изображением.']);
            }
        }

        $validatedData = $request->validated();
        $validatedData['poster_url'] = $path;

        $room->update($validatedData);

        return redirect()->route('h.show', ['hotel' => $room->hotel_id]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        if ($room->poster_url) {
            Storage::disk('public')->delete($room->poster_url);
        }
        Room::destroy($id);
        return redirect()->back()->with('success', 'Комната успешно удалена.');
    }
}
