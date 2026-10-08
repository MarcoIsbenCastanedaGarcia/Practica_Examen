<?php

namespace App\Services;

use App\Models\Cita;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CitaService
{
    public function crear(array $datos): Cita
    {
        try {
            return DB::transaction(function () use ($datos) {

                $ocupada = Cita::query()
                    ->where('fecha', $datos['fecha'])
                    ->where('hora', $datos['hora'])
                    ->exists();

                if ($ocupada) {
                    throw ValidationException::withMessages([
                        'hora' => 'Ese horario ya fue reservado. Elige otra fecha u hora.',
                    ]);
                }

                $datos['estado'] = 'pendiente';

                return Cita::create($datos);
            });
        } catch (QueryException $e) {

            if ((string) $e->getCode() === '23000') {
                throw ValidationException::withMessages([
                    'hora' => 'Ese horario ya fue reservado. Elige otra fecha u hora.',
                ]);
            }

            throw $e;
        }
    }

    public function cambiarEstado(Cita $cita, string $estado): Cita
    {
        if (! in_array(
            $estado,
            ['pendiente', 'confirmada', 'cancelada'],
            true
        )) {
            throw ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        $cita->update([
            'estado' => $estado,
        ]);

        return $cita->fresh();
    }
}