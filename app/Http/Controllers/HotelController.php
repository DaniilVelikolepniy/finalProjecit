<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHotelRequest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{   
    // показать все записи
    public function index()
    {
        $allHotels = Hotel::all();
        return view('hotels.index', ['hotels' => $allHotels]);
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
                return view('hotels.add_hotel_form');
            }
        }
        return redirect()->back()->with('Вы не являетесь администратором');
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

                Hotel::create([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'address' => $request->input('address'),
                    'poster_url' => $path
                ]);

                return redirect()->route('h.list')->with('success', 'Отель успешно добавлен!');
            }
        }

        return back()->with('Вы не являетесь администратором');
    }

    // форма изменения записи
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

        $editId = Hotel::findOrFail($id)->editor_id;

        switch ($idCurrentUser) {
            case 'admin':
                $hotelData = Hotel::findOrFail($id)->toArray();
                return view('hotels.edit_hotel_form', ['data' => $hotelData]);
                break;
            case $editId:
                $hotelData = Hotel::findOrFail($id)->toArray();
                return view('hotels.edit_hotel_form', ['data' => $hotelData]);
                break;
            default:
                return back()->withErrors('У вас нет доступа к данному функционалу');
                break;
        }
    }

    // сохранение изменений
    public function update(StoreHotelRequest $request, $id)
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
                $hotel = Hotel::findOrFail($id);
                $path = $hotel->poster_url;

                if ($request->hasFile('poster_url')) {
                    $file = $request->file('poster_url');

                    if ($file->isValid() && str_starts_with($file->getMimeType(), 'image/')) {
                        if ($hotel->poster_url) {
                            Storage::disk('public')->delete($hotel->poster_url);
                        }

                        $path = $file->store('hotel_images', 'public');
                    } else {
                        return redirect()->back()->withErrors(['poster_url' => 'Файл должен быть изображением.']);
                    }
                }

                $validatedData = $request->toArray();
                $validatedData['poster_url'] = $path;
                Hotel::findOrFail($id)->update($validatedData);
                return redirect()->route('h.list');
                break;
            case $editId:
                $hotel = Hotel::findOrFail($id);
                $path = $hotel->poster_url;

                if ($request->hasFile('poster_url')) {
                    $file = $request->file('poster_url');

                    if ($file->isValid() && str_starts_with($file->getMimeType(), 'image/')) {
                        if ($hotel->poster_url) {
                            Storage::disk('public')->delete($hotel->poster_url);
                        }

                        $path = $file->store('hotel_images', 'public');
                    } else {
                        return redirect()->back()->withErrors(['poster_url' => 'Файл должен быть изображением.']);
                    }
                }

                $validatedData = $request->toArray();
                $validatedData['poster_url'] = $path;
                Hotel::findOrFail($id)->update($validatedData);
                return redirect()->route('h.list');
                break;
            default:
                return redirect()->back()->with('У вас нет прав для выполнения данного действия.');
        }
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
