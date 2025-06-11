<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('layouts.app');
// })->name('home');


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
    'index' => 'r.list',
    'show' => 'r.show',
    'create' => 'r.create',
    'store' => 'r.store',
    'edit' => 'r.edit',
    'update' => 'r.update',
    'destroy' => 'r.destroy',
]);
