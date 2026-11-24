<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Mail\OtpCodeMail;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Mail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Validar usuario y contraseña
    $request->authenticate();

    $user = Auth::user();

    // Generar código OTP de 6 dígitos
    $codigo = random_int(100000, 999999);

    // Eliminar códigos anteriores
    OtpCode::where('user_id', $user->id)->delete();

    // Guardar nuevo código
    OtpCode::create([
        'user_id' => $user->id,
        'codigo' => $codigo,
        'expira_en' => now()->addMinutes(10),
    ]);

    // Enviar correo
    Mail::to($user->email)->send(new OtpCodeMail($codigo));

    // Cerrar sesión temporalmente
    Auth::logout();

    // Guardar el usuario pendiente de verificar
    session([
        'otp_user' => $user->id,
    ]);

    return redirect()->route('otp.form');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
