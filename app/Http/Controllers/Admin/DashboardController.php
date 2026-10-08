<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Formulario;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $pendientes =
            Cita::where(
                'estado',
                'pendiente'
            )->count();

        $confirmadas =
            Cita::where(
                'estado',
                'confirmada'
            )->count();

        $canceladas =
            Cita::where(
                'estado',
                'cancelada'
            )->count();

        $formularios =
            Formulario::count();

        $proximas =
            Cita::with('servicio')
                ->whereDate(
                    'fecha',
                    '>=',
                    today()
                )
                ->where(
                    'estado',
                    '!=',
                    'cancelada'
                )
                ->orderBy('fecha')
                ->orderBy('hora')
                ->limit(10)
                ->get();

        return view(
            'admin.dashboard',
            compact(
                'pendientes',
                'confirmadas',
                'canceladas',
                'formularios',
                'proximas'
            )
        );
    }
}