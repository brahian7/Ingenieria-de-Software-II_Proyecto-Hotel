<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HabitacionController;
use App\Http\Controllers\Api\HuespedController;
use App\Http\Controllers\Api\ReservaController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('api.logout');

    Route::apiResource('habitaciones', HabitacionController::class)
        ->names('api.habitaciones');

    Route::apiResource('huespedes', HuespedController::class)
        ->names('api.huespedes');

    Route::apiResource('reservas', ReservaController::class)
        ->names('api.reservas');

});