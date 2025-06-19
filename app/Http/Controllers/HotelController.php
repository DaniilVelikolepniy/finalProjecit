<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHotelRequest;

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
        $hotelData = Hotel::findOrFail($id)->toArray();
        return view('hotels.hotel_show', ['data' => $hotelData]);
    }

    // форма добавления записи
    public function create()
    {
        return view('hotels.add_hotel_form');
    }

    // сохранить добавленной записи
    public function store(StoreHotelRequest $request)
    {
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

    // форма изменения записи
    public function edit($id)
    {
        $hotelData = Hotel::findOrFail($id)->toArray();
        return view('hotels.edit_hotel_form', ['data' => $hotelData]);
    }

    // сохранение изменений
    public function update(StoreHotelRequest $request, $id)
    {
        $path = null;

        if ($request->hasFile('poster_url')) {
            $path = $request->file('poster_url')->store('hotel_images', 'public');
        }

        $validatedData = $request->toArray();
        $validatedData['poster_url'] = $path;
        Hotel::findOrFail($id)->update($validatedData);
        return redirect()->route('h.list');
    }

    // удаление записи
    public function destroy($id)
    {
        $hotelName = '«' . Hotel::findOrFail($id)->toArray()['name'] . '»';
        if (Hotel::destroy($id)) {
            session()->flash('message', "Отель $hotelName удалён.");
            return back();
        }
    }
}
