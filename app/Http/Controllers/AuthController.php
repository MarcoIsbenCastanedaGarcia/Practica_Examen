<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    public function login(
        Request $request
    ): RedirectResponse {

        $datos = $request->validate([
            'correo' => [
                'required',
                'email',
                'max:150'
            ],

            'password' => [
                'required',
                'string'
            ],
        ]);

        $llave =
            Str::lower($datos['correo'])
            .'|'
            .$request->ip();

        if (
            RateLimiter::tooManyAttempts(
                $llave,
                5
            )
        ) {
            $segundos =
                RateLimiter::availableIn($llave);

            return back()
                ->withInput(
                    $request->only('correo')
                )
                ->withErrors([
                    'correo' =>
                    "Demasiados intentos. Intenta otra vez en {$segundos} segundos.",
                ]);
        }

        if (
            Auth::attempt([
                'correo' => $datos['correo'],
                'password' => $datos['password'],
            ])
        ) {

            if (
                Auth::user()->rol !==
                'nutriologo'
            ) {

                Auth::logout();

                return back()
                    ->withInput(
                        $request->only('correo')
                    )
                    ->withErrors([
                        'correo' =>
                        'La cuenta no tiene acceso al panel del nutriólogo.',
                    ]);
            }

            $request
                ->session()
                ->regenerate();

            RateLimiter::clear($llave);

            return redirect()
                ->route('admin.dashboard');
        }

        RateLimiter::hit(
            $llave,
            60
        );

        return back()
            ->withInput(
                $request->only('correo')
            )
            ->withErrors([
                'correo' =>
                'Las credenciales no coinciden con nuestros registros.',
            ]);
    }

    public function logout(
        Request $request
    ): RedirectResponse {

        Auth::logout();

        $request
            ->session()
            ->invalidate();

        $request
            ->session()
            ->regenerateToken();

        return redirect()
            ->route('login');
    }
}