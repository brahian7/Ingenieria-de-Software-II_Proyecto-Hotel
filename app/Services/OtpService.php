<?php

namespace App\Services;

use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OtpService
{
    public function generar(User $user): void
    {
        // Elimina códigos anteriores
        OtpCode::where('user_id', $user->id)->delete();

        $codigo = random_int(100000, 999999);

        OtpCode::create([
            'user_id' => $user->id,
            'codigo' => $codigo,
            'expira_en' => Carbon::now()->addMinutes(10),
            'usado' => false,
        ]);

        Mail::raw(
            "Tu código OTP para ingresar al Hotel Central es: {$codigo}\n\nEste código expira en 10 minutos.",
            function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Código OTP - Hotel Central');
            }
        );
    }

    public function validar(User $user, string $codigo): bool
    {
        $otp = OtpCode::where('user_id', $user->id)
            ->where('codigo', $codigo)
            ->where('usado', false)
            ->first();

        if (!$otp) {
            return false;
        }

        if (Carbon::now()->greaterThan($otp->expira_en)) {
            return false;
        }

        $otp->update([
            'usado' => true
        ]);

        return true;
    }
}