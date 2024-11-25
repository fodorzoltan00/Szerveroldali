<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/room',[RoomController::class,'index'])->name('room');
//Route::get('/position',[PositionController::class,'index'])->name('position');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::middleware(['auth'])->group(function () {
    Route::resource('rooms', RoomController::class);
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('rooms', RoomController::class);

    Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
    Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
    Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
    Route::get('/positions/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
    Route::put('/positions/{position}', [PositionController::class, 'update'])->name('positions.update');
    Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
    Route::get('/positions/{position}/users', [PositionController::class, 'users'])->name('positions.users');

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
