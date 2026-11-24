<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    /**
     * Login de la API
     */
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credenciales)) {

            return response()->json([
                'message' => 'Credenciales incorrectas.'
            ], 401);

        }

        $usuario = Auth::user();

        // Elimina tokens antiguos (opcional)
        $usuario->tokens()->delete();

        // Crear nuevo token
        $token = $usuario->createToken('hotel-api')->plainTextToken;

        return response()->json([

            'message' => 'Inicio de sesión exitoso.',

            'token' => $token,

            'token_type' => 'Bearer',

            'user' => [
                'id' => $usuario->id,
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
                'email' => $usuario->email,
                'rol' => $usuario->rol,
            ]

        ]);
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.'
        ]);
    }
}