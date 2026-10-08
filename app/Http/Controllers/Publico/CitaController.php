<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Services\CitaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function __construct(
        private readonly CitaService $citaService
    ) {
    }

    public function store(
        Request $request
    ): RedirectResponse {

        $datos = $request->validate([

            'servicio_id' => [
                'nullable',
                'integer',
                'exists:servicios,id'
            ],

            'nombre_paciente' => [
                'required',
                'string',
                'max:120'
            ],

            'telefono' => [
                'required',
                'string',
                'max:25'
            ],

            'correo' => [
                'required',
                'email',
                'max:150'
            ],

            'fecha' => [
                'required',
                'date',
                'after_or_equal:today'
            ],

            'hora' => [
                'required',
                'date_format:H:i'
            ],

            'motivo' => [
                'required',
                'string',
                'max:2000'
            ],
        ]);

        $cita =
            $this->citaService
                ->crear($datos);

        return redirect()
            ->route(
                'formulario.create',
                [
                    'cita' => $cita->id
                ]
            )
            ->with(
                'success',
                'Tu cita fue registrada. Ahora puedes completar tu formulario médico.'
            );
    }
}