<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/room',[RoomController::class,'index'])->name('room');
Route::get('/position',[PositionController::class,'index'])->name('position');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
