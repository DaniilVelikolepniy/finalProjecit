<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function usersList(Request $request)
    {
        $perPage = $request->get('perPage', 10);

        $users = User::with('roles')->paginate($perPage);

        $roles = Role::all();

        $hotels = Hotel::all();

        return view('admins.admins.usersList', compact('users', 'roles', 'hotels'));
    }

    public function usersData(int $id)
    {
        $user = User::findOrFail($id);
        $bookings = Booking::where('user_id', $user->id)->get();
        return view('admins.admins.usersShow', compact('user', 'bookings'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        if (!$user->roles->contains($role->id)) {
            $user->roles()->attach($role->id);
        }

        return back()->with('success', "Роль '{$role->name}' успешно присвоена пользователю {$user->name}");
    }

    public function removeRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        $user->roles()->detach($role->id);

        return back()->with('success', "Роль '{$role->name}' удалена у пользователя {$user->name}");
    }

    public function assignHotel(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $hotel = Hotel::findOrFail($request->hotel_id);
        $hotel->editor_id = $request->user_id;
        $hotel->save();

        return back()->with('success', 'Пользователь назначен редактором отеля!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Пользователь успешно удалён!');
    }
}
