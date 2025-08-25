<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Booking;

class EditorController extends Controller
{
    public function usersList(Request $request)
    {
        $perPage = (int) $request->input('perPage', 10);

        $id = Auth::id();
        $hotelId = Hotel::where('editor_id', $id)->value('id');

        $users = User::with('roles')
            ->whereHas('bookings.room', function ($query) use ($hotelId) {
                $query->where('hotel_id', $hotelId);
            })
            ->distinct()
            ->paginate($perPage)
            ->withQueryString();

        return view('admins.editors.usersList', compact('users'));
    }
}
