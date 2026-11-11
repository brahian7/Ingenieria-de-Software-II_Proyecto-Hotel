<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Mail\OtpCodeMail;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar formulario de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Registrar un nuevo cliente.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'apellido' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $user = User::create([

            'nombre' => $request->nombre,

            'apellido' => $request->apellido,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            // todo usuario registrado desde la web será Cliente
            'rol' => 'Cliente',

            // Activo por defecto
            'estado' => true,

        ]);

        event(new Registered($user));

        /*
        |--------------------------------------------------------------------------
        | Generar OTP
        |--------------------------------------------------------------------------
        */

        $codigo = random_int(100000, 999999);

        /*
        |--------------------------------------------------------------------------
        | Eliminar códigos anteriores
        |--------------------------------------------------------------------------
        */

        OtpCode::where('user_id', $user->id)->delete();

        /*
        |--------------------------------------------------------------------------
        | Guardar nuevo código
        |--------------------------------------------------------------------------
        */

        OtpCode::create([
            'user_id'   => $user->id,
            'codigo'    => $codigo,
            'expira_en' => now()->addMinutes(10),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Enviar correo
        |--------------------------------------------------------------------------
        */

        Mail::to($user->email)->send(
            new OtpCodeMail($codigo)
        );

        /*
        |--------------------------------------------------------------------------
        | Guardar usuario pendiente de verificar
        |--------------------------------------------------------------------------
        */

        session([
            'otp_user' => $user->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Redirigir al formulario OTP
        |--------------------------------------------------------------------------
        */

        return redirect()->route('otp.form');
     }
}