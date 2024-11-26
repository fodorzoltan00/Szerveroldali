<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoomEntryController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/room',[RoomController::class,'index'])->name('room');
//Route::get('/position',[PositionController::class,'index'])->name('position');

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::middleware('auth')->group(function () {
    // Szobák listázása
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

    // Csak admin számára elérhető útvonalak
    Route::middleware(['auth'])->group(function () {
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
        Route::post('rooms/{room}/access', [RoomController::class, 'accessRoom'])->middleware('auth')->name('rooms.access');
        Route::get('rooms/{room}/history', [RoomController::class, 'roomHistory'])->middleware('auth')->name('rooms.history');
    });
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');

    Route::middleware(['auth'])->group(function () {
        Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
        Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
        Route::get('/positions/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
        Route::put('/positions/{position}', [PositionController::class, 'update'])->name('positions.update');
        Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
        Route::get('/positions/{position}/users', [PositionController::class, 'users'])->name('positions.users');
    });
});

Route::get('user_room_entries', [UserRoomEntryController::class, 'index'])->middleware('auth')->name('user_room_entries.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/permissions', [PermissionController::class, 'index'])->middleware('auth')->name('permissions.index');
