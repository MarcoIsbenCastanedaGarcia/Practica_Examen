<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Formulario extends Model
{
    protected $fillable = [
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

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'peso' => 'decimal:2',
            'estatura' => 'decimal:2',
        ];
    }

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }
}