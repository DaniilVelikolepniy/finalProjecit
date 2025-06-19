<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
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
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
