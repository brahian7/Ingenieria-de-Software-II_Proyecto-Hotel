<?php

namespace Database\Factories;

use App\Models\Habitacion;
use App\Models\Huesped;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ReservaFactory extends Factory
{
    protected $model = Reserva::class;

    public function definition(): array
    {
        $habitacion = Habitacion::inRandomOrder()->first();

        $ingreso = $this->faker->dateTimeBetween('+1 day', '+1 month');

        $salida = (clone $ingreso)->modify(
            '+' . $this->faker->numberBetween(1, 7) . ' days'
        );

        $noches = Carbon::parse($ingreso)
            ->diffInDays(Carbon::parse($salida));

        return [

            'codigo_reserva' => 'RES-' . $this->faker->unique()->numerify('######'),

            'usuario_id' => User::inRandomOrder()->first()->id,

            'huesped_id' => Huesped::inRandomOrder()->first()->id,

            'habitacion_id' => $habitacion->id,

            'fecha_reserva' => now(),

            'fecha_ingreso' => $ingreso,

            'fecha_salida' => $salida,

            'cantidad_personas' => $this->faker->numberBetween(1, 4),

            'cantidad_noches' => $noches,

            'precio_noche' => $habitacion->precio_noche,

            'total' => $habitacion->precio_noche * $noches,

            'estado' => $this->faker->randomElement([
                'Pendiente',
                'Confirmada',
                'Cancelada',
                'Finalizada'
            ]),

            'observaciones' => $this->faker->optional()->sentence(),

        ];
    }
}