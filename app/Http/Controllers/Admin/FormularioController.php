<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formulario;
use App\Services\FormularioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FormularioController extends Controller
{
    public function __construct(
        private readonly FormularioService $formularioService
    ) {
    }

    public function index(): View
    {
        $formularios =
            Formulario::with('cita')
                ->latest()
                ->paginate(20);

        return view(
            'admin.formularios.index',
            compact('formularios')
        );
    }

    public function show(
        Formulario $formulario
    ): View {

        $formulario->load(
            'cita.servicio'
        );

        return view(
            'admin.formularios.show',
            compact('formulario')
        );
    }

    public function importar(): View
    {
        return view(
            'admin.formularios.importar'
        );
    }

    public function importarStore(
        Request $request
    ): RedirectResponse {

        $request->validate([
            'archivo' => [
                'required',
                'file',
                'extensions:txt',
                'max:2048'
            ],
        ]);

        $formulario =
            $this->formularioService
                ->importarTxt(
                    $request->file('archivo')
                );

        return redirect()
            ->route(
                'admin.formularios.show',
                $formulario
            )
            ->with(
                'success',
                'Formulario importado correctamente.'
            );
    }

    public function exportar(
        Formulario $formulario
    ): Response {

        $contenido =
            $this->formularioService
                ->exportarTxt(
                    $formulario
                );

        return response(
            $contenido,
            200,
            [
                'Content-Type' =>
                'text/plain; charset=UTF-8',

                'Content-Disposition' =>
                'attachment; filename="formulario_'
                .$formulario->id
                .'.txt"',
            ]
        );
    }
}