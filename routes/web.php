<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Models\Booking;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
})->name('home');


Route::resource('/hotels', HotelController::class)->names([
    'index' => 'h.list',
    'show' => 'h.show',
    'create' => 'h.create',
    'store' => 'h.store',
    'edit' => 'h.edit',
    'update' => 'h.update',
    'destroy' => 'h.destroy',
]);

Route::resource('/rooms', RoomController::class)->names([
    'index' => 'r.index',
    'show' => 'r.show',
    'create' => 'r.create',
    'store' => 'r.store',
    'edit' => 'r.edit',
    'update' => 'r.update',
    'destroy' => 'r.destroy',
]);

Route::resource('/bookings', BookingController::class)->names([
    'index' => 'b.index',
    'show' => 'b.show',
    'create' => 'b.create',
    'store' => 'b.store',
    'edit' => 'b.edit',
    'update' => 'b.update',
    'destroy' => 'b.destroy',
]);
