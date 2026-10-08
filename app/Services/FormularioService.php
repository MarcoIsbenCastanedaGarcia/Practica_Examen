<?php

namespace App\Services;

use App\Models\Formulario;
use DateTimeInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class FormularioService
{
    private const CAMPOS = [
        'cita_id',
        'nombre_paciente',
        'fecha_nacimiento',
        'sexo',
        'peso',
        'estatura',
        'objetivo',
        'antecedentes_personales',
        'antecedentes_familiares',
        'alergias',
        'medicamentos',
        'habitos_alimenticios',
        'actividad_fisica',
        'consumo_agua',
        'observaciones',
    ];

    public function crear(array $datos): Formulario
    {
        return Formulario::create($datos);
    }

    public function exportarTxt(Formulario $formulario): string
    {
        $lineas = [
            '# Formulario nutricional'
        ];

        foreach (self::CAMPOS as $campo) {

            $valor = $formulario->{$campo};

            if ($valor instanceof DateTimeInterface) {
                $valor = $valor->format('Y-m-d');
            }

            $valor = $valor === null
                ? ''
                : (string) $valor;

            $valor = str_replace(
                ["\r\n", "\r", "\n"],
                '\n',
                $valor
            );

            $lineas[] = $campo.'='.$valor;
        }

        return implode(PHP_EOL, $lineas).PHP_EOL;
    }

    public function importarTxt(UploadedFile $archivo): Formulario
    {
        $contenido = $archivo->get();

        $datos = [];

        foreach (preg_split('/\R/', $contenido) ?: [] as $linea) {

            $linea = trim($linea);

            if (
                $linea === '' ||
                str_starts_with($linea, '#') ||
                ! str_contains($linea, '=')
            ) {
                continue;
            }

            [$campo, $valor] = explode('=', $linea, 2);

            $campo = trim($campo);

            if (! in_array($campo, self::CAMPOS, true)) {
                continue;
            }

            $valor = str_replace(
                '\n',
                PHP_EOL,
                trim($valor)
            );

            $datos[$campo] =
                $valor === ''
                    ? null
                    : $valor;
        }

        $validados = Validator::make($datos, [

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

        ])->validate();

        return $this->crear($validados);
    }
}