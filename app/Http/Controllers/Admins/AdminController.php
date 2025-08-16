<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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

        return view('admins.admins.usersList', compact('users', 'roles'));
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
}
