<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Facility;
use App\Models\FacilityHotel;
use App\Models\FacilityRoom;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
    public function create(int $id)
    {
        $idCurrentUser = Auth::id();

        // Проверка на админа
        $adminRole = 'admin';
        $admins = User::whereHas('roles', function ($query) use ($adminRole) {
            $query->where('name', $adminRole);
        })->get()->toArray();

        foreach ($admins as $admin) {
            if ($idCurrentUser === $admin['id']) {
                // Пользователь админ — получает доступ ко всем отелям
                $hotels = Hotel::all();
                $hotel = Hotel::with('facilities')->findOrFail($id);

                return view('rooms.add_room_form', [
                    'hotels'     => $hotels,
                    'facilities' => $hotel->facilities,
                    'hotel'      => $hotel,
                ]);
            }
        }

        // Проверка на редактора
        $editorRole = 'editor';
        $editors = User::whereHas('roles', function ($query) use ($editorRole) {
            $query->where('name', $editorRole);
        })->get()->toArray();

        foreach ($editors as $editor) {
            if ($idCurrentUser === $editor['id']) {
                // Загружаем отель и его удобства
                $hotel = Hotel::with('facilities')->findOrFail($id);

                // Проверяем, что редактор действительно привязан к этому отелю
                if ($hotel->editor_id !== $idCurrentUser) {
                    return redirect()->back()->with('error', 'Вы не можете добавлять комнаты в этот отель');
                }

                $hotels = Hotel::where('editor_id', $idCurrentUser)->get();

                return view('rooms.add_room_form', [
                    'hotels'     => $hotels,
                    'facilities' => $hotel->facilities,
                    'hotel'      => $hotel,
                ]);
            }
        }

        // Если не админ и не редактор
        return redirect()->back()->with('error', 'Вы не являетесь редактором');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $idCurrentUser = Auth::id();

        $roleName = 'admin';

        $admins = User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get()->toArray();

        foreach ($admins as $admin) {
            if ($idCurrentUser === $admin['id']) {
                $idCurrentUser = $roleName;
            }
        }

        $hotelId = $request->hotel_id;
        $editorId = Hotel::findOrFail($hotelId)->editor_id;

        switch ($idCurrentUser) {
            case 'admin':
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'price_per_night' => 'required|min:0',
                    'area' => 'nullable|min:0',
                    'room_class' => 'nullable|string|max:50',
                    'hotel_id' => 'required|exists:hotels,id',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                    'facilities' => 'nullable|array',
                    'facilities.*' => 'exists:facilities,id',
                ]);

                $imagePath = null;
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('room_images', 'public');
                }

                $room = Room::create([
                    'name'        => $validated['name'],
                    'description' => $validated['description'] ?? null,
                    'poster_url'  => $imagePath,
                    'floor_area'  => $validated['area'] ?? null,
                    'type'        => $validated['room_class'] ?? null,
                    'price'       => $validated['price_per_night'],
                    'hotel_id'    => $validated['hotel_id'],
                ]);

                // сохраняем удобства в промежуточную таблицу facility_rooms
                if (!empty($validated['facilities'])) {
                    $room->facilities()->sync($validated['facilities']);
                }

                return redirect()->route('h.show', ['hotel' => $request->hotel_id]);

            case $editorId:
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'price_per_night' => 'required|min:0',
                    'area' => 'nullable|min:0',
                    'room_class' => 'nullable|string|max:50',
                    'hotel_id' => 'required|exists:hotels,id',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                    'facilities' => 'nullable|array',
                    'facilities.*' => 'exists:facilities,id',
                ]);

                $imagePath = null;
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('room_images', 'public');
                }

                $room = Room::create([
                    'name'        => $validated['name'],
                    'description' => $validated['description'] ?? null,
                    'poster_url'  => $imagePath,
                    'floor_area'  => $validated['area'] ?? null,
                    'type'        => $validated['room_class'] ?? null,
                    'price'       => $validated['price_per_night'],
                    'hotel_id'    => $validated['hotel_id'],
                ]);

                if (!empty($validated['facilities'])) {
                    $room->facilities()->sync($validated['facilities']);
                }

                return redirect()->route('h.show', ['hotel' => $request->hotel_id]);

            default:
                return redirect()->back()->withErrors('success', 'Вы не являетесь представителем этого отеля');
        }
    }

    /**(
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $idCurrentUser = Auth::id();
        $roleName = 'admin';

        $admins = User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get()->toArray();

        foreach ($admins as $admin) {
            if ($idCurrentUser === $admin['id']) {
                $idCurrentUser = $roleName;
            }
        }

        $hotelId = Room::where('id', $id)->value('hotel_id');
        $editorId = Hotel::where('id', $hotelId)->value('editor_id');

        switch ($idCurrentUser) {
            case $roleName:
                $room = Room::with('facilities')->findOrFail($id);
                $roomData = $room->toArray();
                $hotels = Hotel::all();
                $roomFacilities = $room->facilities->pluck('id')->toArray();

                return view('rooms.edit_room_form', [
                    'data'            => $roomData,
                    'hotels'          => $hotels,
                    'facilities'      => Facility::all(), // чтобы админ видел все удобства
                    'roomFacilities'  => $roomFacilities,
                ]);
                break;

            case $editorId:
                $room = Room::with('facilities')->findOrFail($id);
                $data = $room->toArray();
                $hotels = Hotel::where('editor_id', $idCurrentUser)
                    ->with('facilities')
                    ->get();
                $facilities = $hotels->isNotEmpty() ? $hotels->first()->facilities : collect();
                $roomFacilities = $room->facilities->pluck('id')->toArray();

                return view('rooms.edit_room_form', compact('data', 'hotels', 'facilities', 'roomFacilities'));
                break;

            default:
                return back()->with('success', 'У вас нет доступа к данному ресурсу');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoomRequest $request, $id)
    {
        $idCurrentUser = Auth::id();
        $roleName = 'admin';

        $admins = User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get()->toArray();

        foreach ($admins as $admin) {
            if ($idCurrentUser === $admin['id']) {
                $idCurrentUser = $roleName;
            }
        }

        $hotelId = Room::where('id', $id)->value('hotel_id');
        $editorId = Hotel::where('id', $hotelId)->value('editor_id');

        switch ($idCurrentUser) {
            case $roleName:
            case $editorId:
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

                $facilities = $request->input('facilities', []);
                $room->facilities()->sync($facilities);

                return redirect()->route('h.show', ['hotel' => $room->hotel_id]);

            default:
                return back()->with('success', 'У вас нет доступа к данному функционалу');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idCurrentUser = Auth::id();
        $roleAdmin = 'admin';

        $admins = User::whereHas('roles', function ($query) use ($roleAdmin) {
            $query->where('name', $roleAdmin);
        })->get()->toArray();

        foreach ($admins as $admin) {
            if ($idCurrentUser === $admin['id']) {
                $idCurrentUser = $roleAdmin;
            }
        }

        $hotelId = Room::where('id', $id)->value('hotel_id');
        $editorId = Hotel::where('id',  $hotelId)->value('editor_id');

        switch ($idCurrentUser) {
            case $roleAdmin:
                $room = Room::findOrFail($id);

                if ($room->poster_url) {
                    Storage::disk('public')->delete($room->poster_url);
                }
                Room::destroy($id);
                return redirect()->back()->with('success', 'Комната успешно удалена.');
                break;
            case $editorId:
                $room = Room::findOrFail($id);

                if ($room->poster_url) {
                    Storage::disk('public')->delete($room->poster_url);
                }

                // $facilities = FacilityRoom::where('room_id', $room->id)->get()->toArray();
                // foreach ($facilities as $facility) {
                //     FacilityRoom::destroy($facility['id']);
                // }

                $room->facilities()->detach();

                Room::destroy($id);
                return redirect()->back()->with('success', 'Комната успешно удалена.');
                break;
            default:
                return redirect()->back()->with('success', 'У вас нет доступа к данному функционалу');
                break;
        }
    }
}
