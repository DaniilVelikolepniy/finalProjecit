<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Отображение страницы профиля текущего пользователя.
     */
    public function show()
    {
        $user = User::getUserById(Auth::id());

        return view('profile.show', compact('user'));
    }
}
