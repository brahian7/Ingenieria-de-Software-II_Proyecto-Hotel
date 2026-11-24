<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\HuespedController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\Cliente\ReservaClienteController;
use App\Http\Controllers\OtpController;

/*
|--------------------------------------------------------------------------
| Portal del Hotel
|--------------------------------------------------------------------------
|
| Página pública donde ingresan los clientes.
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Administrador y Recepcionista
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Administrador,Recepcionista')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Huéspedes
        |--------------------------------------------------------------------------
        */

        // Exportar PDF
        Route::get('huespedes/pdf', [HuespedController::class, 'pdf'])
            ->name('huespedes.pdf');

// CRUD
Route::resource('huespedes', HuespedController::class);

        /*
        |--------------------------------------------------------------------------
        | Reservas
        |--------------------------------------------------------------------------
        */

        // Exportar listado de reservas a PDF
        Route::get(
            'reservas/exportar/pdf',
            [ReservaController::class, 'exportarPDF']
        )->name('reservas.exportar.pdf');

        // CRUD de reservas
        Route::resource('reservas', ReservaController::class);

        /*
        |--------------------------------------------------------------------------
        | Perfil
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');

    });

    /*
    |--------------------------------------------------------------------------
    | Solo Administrador
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Administrador')->group(function () {

        Route::resource('habitaciones', HabitacionController::class);

    });

});

/*
|--------------------------------------------------------------------------
| Portal del Cliente
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Cliente'])
    ->prefix('cliente')
    ->name('cliente.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Mis reservas
        |--------------------------------------------------------------------------
        */

        Route::get('/reservas', [ReservaClienteController::class, 'index'])
            ->name('reservas');

        /*
        |--------------------------------------------------------------------------
        | Buscar habitaciones
        |--------------------------------------------------------------------------
        */

        Route::get('/reservar', [ReservaClienteController::class, 'create'])
            ->name('reservar');

        Route::post('/reservar', [ReservaClienteController::class, 'store'])
            ->name('reservar.store');

        /*
        |--------------------------------------------------------------------------
        | Confirmar reserva
        |--------------------------------------------------------------------------
        */

        Route::post('/confirmar-reserva', [ReservaClienteController::class, 'confirmar'])
            ->name('reservar.confirmar');

        Route::post('/guardar-reserva', [ReservaClienteController::class, 'guardar'])
            ->name('reservar.guardar');

        /*
        |--------------------------------------------------------------------------
        | Cancelar reserva
        |--------------------------------------------------------------------------
        */

        Route::patch('/reservas/{reserva}/cancelar', [
            ReservaClienteController::class,
            'cancelar'
        ])->name('reservas.cancelar');

    });

/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/

    Route::get('/otp', [OtpController::class, 'create'])
    ->name('otp.form');

Route::post('/otp', [OtpController::class, 'store'])
    ->name('otp.verify');

require __DIR__.'/auth.php';