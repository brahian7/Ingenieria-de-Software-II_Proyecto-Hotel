<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [

        'codigo_reserva',

        'usuario_id',

        'huesped_id',

        'habitacion_id',

        'fecha_reserva',

        'fecha_ingreso',

        'fecha_salida',

        'cantidad_personas',

        'cantidad_noches',

        'precio_noche',

        'total',

        'estado',

        'observaciones'

    ];

    protected function casts(): array
    {
        return [

            'fecha_reserva' => 'date',

            'fecha_ingreso' => 'date',

            'fecha_salida' => 'date',

            'precio_noche' => 'decimal:2',

            'total' => 'decimal:2',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

        public function huesped()
    {
        return $this->belongsTo(Huesped::class);
    }

        public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

        public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}