<?php

namespace App\Services;

use App\Models\Servicio;
use Illuminate\Database\Eloquent\Collection;

class ServicioService
{
    public function activos(): Collection
    {
        return Servicio::query()
            ->where('activo', true)
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();
    }

    public function todos(): Collection
    {
        return Servicio::query()
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();
    }
}