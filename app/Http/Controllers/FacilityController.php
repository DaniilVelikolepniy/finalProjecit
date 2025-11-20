<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilites = Facility::all();
        return view('facilitys.list', compact('facilites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facilitys.addForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Facility::create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('f.list')->with('success', 'Удобство успешно создано');
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
    public function edit(int $id)
    {
        $facility = Facility::findOrFail($id);

        return view('facilitys.editForm', ['facility' => $facility]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $facility = Facility::findOrFail($id);

        $facility->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('f.list')->with('success', 'Удобство успешно обновлено');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();

        return redirect()->route('f.list')->with('success', 'Удобство успешно удалено');
    }

}
