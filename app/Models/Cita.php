<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cita extends Model
{
    protected $fillable = [
        'servicio_id',
        'nombre_paciente',
        'telefono',
        'correo',
        'fecha',
        'hora',
        'motivo',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class);
    }

    public function formulario(): HasOne
    {
        return $this->hasOne(Formulario::class);
    }
}