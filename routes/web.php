<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/room',[RoomController::class,'index'])->name('room');
Route::get('/worker',[WorkerController::class,'index'])->name('worker');
Route::get('/position',[PositionController::class,'index'])->name('position');
