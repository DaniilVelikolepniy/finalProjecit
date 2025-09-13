<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHotelRequest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Facility;

class HotelController extends Controller
{
    // показать все записи
    public function index(Request $request)
    {
        $query = Hotel::with(['facilities', 'rooms']);

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereHas('rooms', function ($roomQuery) use ($request) {
                if ($request->filled('min_price')) {
                    $roomQuery->where('price', '>=', (float) $request->min_price);
                }
                if ($request->filled('max_price')) {
                    $roomQuery->where('price', '<=', (float) $request->max_price);
                }
            });
        }

        if ($request->filled('facilities')) {
            foreach ($request->input('facilities') as $facilityId) {
                $query->whereHas('facilities', function ($facilityQuery) use ($facilityId) {
                    $facilityQuery->where('facilities.id', $facilityId);
                });
            }
        }

        $hotels = $query->paginate(12)->withQueryString();
        $facilities = Facility::all();

        return view('hotels.index', compact('hotels', 'facilities'));
    }

    // показать конкретную запись
    public function show($id)
    {
        $hotelData = Hotel::findOrFail($id);
        $roomsData = Room::where('hotel_id', $id)->get();
        return view('hotels.show', ['hotel' => $hotelData, 'rooms' => $roomsData]);
    }

    // форма добавления записи
    public function create()
    {
        $idCurrentUser = Auth::id();
        $roleName = 'admin';

        $admins = User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get()->toArray();

        foreach ($admins as $admin) {
            if ($idCurrentUser === $admin['id']) {
                $facilities = Facility::all();
                return view('hotels.add_hotel_form', compact('facilities'));
            }
        }

        return redirect()->back()->with('error', 'Вы не являетесь администратором');
    }



    // сохранить добавленной записи
    public function store(StoreHotelRequest $request)
    {
        $idCurrentUser = Auth::id();
        $roleName = 'admin';

        $admins = User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get()->toArray();

        foreach ($admins as $admin) {
            if ($idCurrentUser === $admin['id']) {

                $path = null;
                if ($request->hasFile('poster_url')) {
                    $path = $request->file('poster_url')->store('hotel_images', 'public');
                }

                $hotel = Hotel::create([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'address' => $request->input('address'),
                    'poster_url' => $path
                ]);

                if ($request->has('facilities')) {
                    $hotel->facilities()->sync($request->input('facilities'));
                }

                return redirect()->route('h.list')->with('success', 'Отель успешно добавлен!');
            }
        }

        return back()->with('error', 'Вы не являетесь администратором');
    }



    // форма изменения записи
    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $facilities = Facility::all();
        $selectedFacilities = $hotel->facilities()->pluck('facilities.id')->toArray();

        $data = [
            'id' => $hotel->id,
            'name' => $hotel->name,
            'description' => $hotel->description,
            'address' => $hotel->address,
            'poster_url' => $hotel->poster_url,
            'facilities' => $selectedFacilities,
        ];

        return view('hotels.edit_hotel_form', compact('data', 'facilities'));
    }


    // сохранение изменений
    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);

        $path = $hotel->poster_url;
        if ($request->hasFile('poster_url')) {
            $path = $request->file('poster_url')->store('hotel_images', 'public');
        }

        $hotel->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'poster_url' => $path,
        ]);

        $hotel->facilities()->sync($request->input('facilities', []));

        return redirect()->route('h.list')->with('success', 'Информация об отеле обновлена!');
    }


    // удаление записи
    public function destroy($id)
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

        $editId = Hotel::findOrFail($id)->editor_id;
        switch ($idCurrentUser) {
            case 'admin':
                $hotelName = '«' . Hotel::findOrFail($id)->toArray()['name'] . '»';
                if (Hotel::destroy($id)) {
                    session()->flash('message', "Отель $hotelName удалён.");
                    return redirect()->route('h.list');
                }
                break;
            case $editId:
                $hotelName = '«' . Hotel::findOrFail($id)->toArray()['name'] . '»';
                if (Hotel::destroy($id)) {
                    session()->flash('message', "Отель $hotelName удалён.");
                    return redirect()->route('h.list');
                }
                break;
            default:
                return redirect()->back()->with('У вас нет прав для выполнения данного действия');
        }
    }
}
