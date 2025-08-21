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
    public function usersList()
    {
        $id = Auth::id();
        $hotelId = Hotel::where('editor_id', $id)->value('id');
        $users = User::query()
            ->whereHas('bookings.room', function ($query) use ($hotelId) {
                $query->where('hotel_id', $hotelId);
            })
            ->distinct()
            ->get();
        
        return view('admins.editors.usersList', compact('users'));
    }
}
