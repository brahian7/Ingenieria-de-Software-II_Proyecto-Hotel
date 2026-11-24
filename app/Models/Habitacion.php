<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';

    protected $fillable = [
        'numero',
        'tipo',
        'capacidad',
        'precio_noche',
        'estado',
        'descripcion',
        'imagen'
    ];

    protected function casts(): array
    {
        return [
            'precio_noche' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeDisponibles($query)
    {
        return $query->where('estado', 'Disponible');
    }

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}