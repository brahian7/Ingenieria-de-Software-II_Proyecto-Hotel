<?php

namespace Database\Factories;

use App\Models\Habitacion;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class HabitacionFactory extends Factory
{
    protected $model = Habitacion::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('es_CO');

        return [

            'numero' => $faker->unique()->numberBetween(101, 999),

            'tipo' => $faker->randomElement([
                'Sencilla',
                'Doble',
                'Triple',
                'Suite',
            ]),

            'capacidad' => $faker->numberBetween(1, 6),

            'precio_noche' => $faker->randomFloat(2, 80000, 500000),

            'estado' => $faker->randomElement([
                'Disponible',
                'Ocupada',
                'Mantenimiento',
            ]),

            'descripcion' => $faker->sentence(),

            'imagen' => null,

        ];
    }
}