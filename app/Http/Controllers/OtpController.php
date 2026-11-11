<?php

namespace App\Http\Controllers;

use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpCodeMail;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    /**
     * Mostrar formulario OTP
     */
        public function create()
    {
        if (!session()->has('otp_user')) {
            return redirect()->route('login');
        }

        $user = User::find(session('otp_user'));

        if (!$user) {
            return redirect()->route('login');
        }

        $otp = OtpCode::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$otp) {
            return redirect()->route('login');
        }

        return view('auth.otp', [
            'expiraEn' => $otp->expira_en->timestamp,
            'creadoEn' => $otp->created_at->timestamp,
            'correo' => $user->email,
        ]);
    }

    /**
     * Verificar código OTP
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|digits:6',
        ]);

        $user = User::find(session('otp_user'));

        if (!$user) {
            return redirect()->route('login');
        }

        $otp = OtpCode::where('user_id', $user->id)
            ->where('codigo', $request->codigo)
            ->latest()
            ->first();

        if (!$otp) {
            return back()->withErrors([
                'codigo' => 'El código es incorrecto.'
            ]);
        }

        if (now()->greaterThan($otp->expira_en)) {
            return back()->withErrors([
                'codigo' => 'El código ha expirado.'
            ]);
        }

        Auth::login($user);

        $otp->delete();

        session()->forget('otp_user');

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

        public function resend()
    {
        if (!session()->has('otp_user')) {
            return redirect()->route('login');
        }

        $user = User::find(session('otp_user'));

        if (!$user) {
            return redirect()->route('login');
        }

        // Buscar el último código generado
        $ultimoOtp = OtpCode::where('user_id', $user->id)
            ->latest()
            ->first();

        if ($ultimoOtp) {

            $segundosTranscurridos = now()->diffInSeconds(
                $ultimoOtp->created_at
            );

            if ($segundosTranscurridos < 60) {

                $faltan = 60 - $segundosTranscurridos;

                return back()->withErrors([
                    'codigo' => "Debes esperar {$faltan} segundos para solicitar otro código."
                ]);

            }

        }

        // Eliminar códigos anteriores
        OtpCode::where('user_id', $user->id)->delete();

        // Generar nuevo código
        $codigo = random_int(100000, 999999);

        OtpCode::create([
            'user_id' => $user->id,
            'codigo' => $codigo,
            'expira_en' => now()->addMinutes(10),
        ]);

        // Enviar correo
        Mail::to($user->email)->send(
            new OtpCodeMail($codigo)
        );

        return back()->with(
            'status',
            'Se envió un nuevo código a tu correo.'
        );
    }
}