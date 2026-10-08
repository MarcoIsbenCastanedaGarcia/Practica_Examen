<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Services\CitaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CitaController extends Controller
{
    public function __construct(
        private readonly CitaService $citaService
    ) {
    }

    public function index(
        Request $request
    ): View {

        $query =
            Cita::with([
                'servicio',
                'formulario'
            ]);

        if ($request->filled('estado')) {
            $query->where(
                'estado',
                $request
                    ->string('estado')
                    ->toString()
            );
        }

        $citas =
            $query
                ->orderBy('fecha')
                ->orderBy('hora')
                ->paginate(20)
                ->withQueryString();

        return view(
            'admin.citas.index',
            compact('citas')
        );
    }

    public function show(
        Cita $cita
    ): View {

        $cita->load([
            'servicio',
            'formulario'
        ]);

        return view(
            'admin.citas.show',
            compact('cita')
        );
    }

    public function estado(
        Request $request,
        Cita $cita
    ): RedirectResponse {

        $datos = $request->validate([
            'estado' => [
                'required',
                'in:pendiente,confirmada,cancelada'
            ],
        ]);

        $this->citaService
            ->cambiarEstado(
                $cita,
                $datos['estado']
            );

        return back()->with(
            'success',
            'Estado de la cita actualizado correctamente.'
        );
    }
}