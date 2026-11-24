<?php

namespace Database\Factories;

use App\Models\Huesped;
use Illuminate\Database\Eloquent\Factories\Factory;

class HuespedFactory extends Factory
{
    protected $model = Huesped::class;

    public function definition(): array
    {
        return [

            'tipo_documento' => $this->faker->randomElement([
                'CC',
                'CE',
                'Pasaporte'
            ]),

            'numero_documento' => $this->faker->unique()->numerify('##########'),

            'nombres' => $this->faker->firstName(),

            'apellidos' => $this->faker->lastName(),

            'telefono' => $this->faker->numerify('3#########'),

            'correo' => $this->faker->unique()->safeEmail(),

            'direccion' => $this->faker->streetAddress(),

            'ciudad' => $this->faker->city(),

            'fecha_registro' => now(),

        ];
    }
}