<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NutriologoMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->rol !== 'nutriologo') {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'correo' =>
                    'No tienes permiso para acceder al panel administrativo.',
                ]);
        }

        return $next($request);
    }
}