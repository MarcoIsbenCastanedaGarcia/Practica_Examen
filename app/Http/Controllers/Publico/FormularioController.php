<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Services\FormularioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FormularioController extends Controller
{
    public function __construct(
        private readonly FormularioService $formularioService
    ) {
    }

    public function create(
        Request $request
    ): View {

        $cita = null;

        if ($request->filled('cita')) {
            $cita = Cita::find(
                $request->integer('cita')
            );
        }

        return view(
            'publico.formulario',
            compact('cita')
        );
    }

    public function store(
        Request $request
    ): RedirectResponse {

        $datos = $request->validate([

            'cita_id' => [
                'nullable',
                'integer',
                'exists:citas,id',
                'unique:formularios,cita_id'
            ],

            'nombre_paciente' => [
                'required',
                'string',
                'max:120'
            ],

            'fecha_nacimiento' => [
                'nullable',
                'date',
                'before_or_equal:today'
            ],

            'sexo' => [
                'nullable',
                'string',
                'max:30'
            ],

            'peso' => [
                'nullable',
                'numeric',
                'between:1,500'
            ],

            'estatura' => [
                'nullable',
                'numeric',
                'between:30,260'
            ],

            'objetivo' => [
                'nullable',
                'string',
                'max:3000'
            ],

            'antecedentes_personales' => [
                'nullable',
                'string',
                'max:5000'
            ],

            'antecedentes_familiares' => [
                'nullable',
                'string',
                'max:5000'
            ],

            'alergias' => [
                'nullable',
                'string',
                'max:3000'
            ],

            'medicamentos' => [
                'nullable',
                'string',
                'max:3000'
            ],

            'habitos_alimenticios' => [
                'nullable',
                'string',
                'max:5000'
            ],

            'actividad_fisica' => [
                'nullable',
                'string',
                'max:3000'
            ],

            'consumo_agua' => [
                'nullable',
                'string',
                'max:100'
            ],

            'observaciones' => [
                'nullable',
                'string',
                'max:5000'
            ],

        ]);

        $this->formularioService
            ->crear($datos);

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Formulario guardado correctamente.'
            );
    }
}