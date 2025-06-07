<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('layouts.app');
// })->name('home');


Route::resource('/hotels', HotelController::class)->names([
    'index'=>'h.list',
    'show'=>'h.show',
    'create'=>'h.create',
    'store'=>'h.store',
    'edit'=>'h.edit',
    'update'=>'h.update',
    'destroy'=>'h.destroy',
]);
