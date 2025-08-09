<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function usersList(Request $request)
    {
        $perPage = $request->get('perPage', 10);

        $users = User::with('roles')->paginate($perPage);

        return view('admins.admins.usersList', compact('users'));
    }
}
