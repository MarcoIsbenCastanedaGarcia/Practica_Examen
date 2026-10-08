<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Services\ServicioService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly ServicioService $servicioService
    ) {
    }

    public function index(): View
    {
        $servicios =
            $this->servicioService->activos();

        return view(
            'publico.inicio',
            compact('servicios')
        );
    }
}