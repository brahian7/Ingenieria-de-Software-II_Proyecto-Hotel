<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar las migraciones.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {

            $table->id();

            // Código único de la reserva
            $table->string('codigo_reserva')->unique();

            // Usuario que registra la reserva
            $table->foreignId('usuario_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Huésped
            $table->foreignId('huesped_id')
                ->constrained('huespedes')
                ->cascadeOnDelete();

            // Habitación
            $table->foreignId('habitacion_id')
                ->constrained('habitaciones')
                ->cascadeOnDelete();

            // Fechas
            $table->date('fecha_reserva');

            $table->date('fecha_ingreso');

            $table->date('fecha_salida');

            // Personas hospedadas
            $table->integer('cantidad_personas');

            // Cantidad de noches
            $table->integer('cantidad_noches');

            // Precio de la habitación al momento de reservar
            $table->decimal('precio_noche', 10, 2);

            // Valor total de la reserva
            $table->decimal('total', 10, 2);

            // Estado de la reserva
            $table->string('estado')
            ->default('Pendiente');

            // Observaciones
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};