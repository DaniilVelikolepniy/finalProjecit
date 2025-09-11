<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\EditorController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FacilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Models\Booking;
use App\Http\Controllers\RoleController;
use App\Models\Role;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
})->middleware('auth')->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/authUser', [AuthController::class, 'login'])->name('auth');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/users', [AdminController::class, 'usersList'])->name('usersListForAdmin')->middleware('role:admin');
    Route::get('/user_info/{id}', [AdminController::class, 'usersData'])->name('u.info')->middleware('role:admin');
    Route::post('/users/assign-role', [AdminController::class, 'assignRole'])->name('u.assignRole')->middleware('role:admin');
    Route::post('/users/remove-role', [AdminController::class, 'removeRole'])->name('u.removeRole')->middleware('role:admin');
    Route::post('/users/assign-hotel', [AdminController::class, 'assignHotel'])->name('u.assignHotel')->middleware('role:admin');
    Route::delete('/users/user-destroy/{id}', [AdminController::class, 'destroy'])->name('u.destroy')->middleware('role:admin');

    Route::get('/hotel_guest', [EditorController::class, 'usersList'])->name('e.usersList')->middleware('role:admin,editor');

    Route::prefix('roles')
        ->name('roles.')
        ->middleware('role:admin')
        ->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/', [RoleController::class, 'store'])->name('store');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
            Route::put('/{role}', [RoleController::class, 'update'])->name('update');
            Route::get('/{role}/users', [RoleController::class, 'users'])->name('users');
            Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    });

    Route::resource('/facilitys', FacilityController::class)->names([
        'create' => 'f.create',
        'store'  => 'f.store',
    ]);

    //методы list и show
    Route::resource('/hotels', HotelController::class)->names([
        'index'   => 'h.list',
        'show'    => 'h.show',
        'create'  => 'h.create',
        'store'   => 'h.store',
        'edit'    => 'h.edit',
        'update'  => 'h.update',
        'destroy' => 'h.destroy',
    ]);

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('/hotels', HotelController::class)
            ->only(['create', 'store'])
            ->names([
                'create' => 'h.create',
                'store'  => 'h.store',
        ]);
    });

    Route::middleware(['role:admin,editor'])->group(function () {
        Route::resource('/hotels', HotelController::class)
            ->only(['edit', 'update', 'destroy'])
            ->names([
                'edit'    => 'h.edit',
                'update'  => 'h.update',
                'destroy' => 'h.destroy',
            ]);
    });

    Route::resource('/rooms', RoomController::class)
        ->names([
            'index'   => 'r.index',
            'create'  => 'r.create',
            'store'   => 'r.store',
            'edit'    => 'r.edit',
            'update'  => 'r.update',
            'destroy' => 'r.destroy',
    ]);

    Route::middleware(['role:admin,editor'])->group(function () {
        Route::resource('/rooms', RoomController::class)
            ->only(['create', 'store', 'edit', 'update', 'destroy'])
            ->names([
                'create'  => 'r.create',
                'store'   => 'r.store',
                'edit'    => 'r.edit',
                'update'  => 'r.update',
                'destroy' => 'r.destroy',
        ]);
    });

    Route::resource('/bookings', BookingController::class)->names([
        'index'   => 'b.index',
        'show'    => 'b.show',
        'create'  => 'b.create',
        'store'   => 'b.store',
        'edit'    => 'b.edit',
        'update'  => 'b.update',
        'destroy' => 'b.destroy',
    ]);

    Route::resource('/bookings', BookingController::class)
        ->only(['edit', 'update'])
        ->middleware(['role:admin,editor'])
        ->names([
            'edit'    => 'b.edit',
            'update'  => 'b.update',
    ]);
});
