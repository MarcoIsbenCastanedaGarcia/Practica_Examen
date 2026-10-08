<?php

use App\Http\Controllers\Admin\CitaController as AdminCitaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormularioController as AdminFormularioController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Publico\CitaController as PublicoCitaController;
use App\Http\Controllers\Publico\FormularioController as PublicoFormularioController;
use App\Http\Controllers\Publico\HomeController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| SITIO PÚBLICO
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [
        HomeController::class,
        'index'
    ]
)->name('home');


Route::post(
    '/citas',
    [
        PublicoCitaController::class,
        'store'
    ]
)->name('citas.store');


Route::get(
    '/formulario',
    [
        PublicoFormularioController::class,
        'create'
    ]
)->name('formulario.create');


Route::post(
    '/formulario',
    [
        PublicoFormularioController::class,
        'store'
    ]
)->name('formulario.store');


/*
|--------------------------------------------------------------------------
| LOGIN DEL NUTRIÓLOGO
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [
        AuthController::class,
        'showLogin'
    ]
)->name('login');


Route::post(
    '/login',
    [
        AuthController::class,
        'login'
    ]
)->name('login.post');


Route::post(
    '/logout',
    [
        AuthController::class,
        'logout'
    ]
)->name('logout');


/*
|--------------------------------------------------------------------------
| PANEL DEL NUTRIÓLOGO
|--------------------------------------------------------------------------
*/

Route::middleware('nutriologo')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |------------------------------------------------------
        | Dashboard
        |------------------------------------------------------
        */

        Route::get(
            '/panel',
            [
                DashboardController::class,
                'index'
            ]
        )->name('dashboard');


        /*
        |------------------------------------------------------
        | Citas
        |------------------------------------------------------
        */

        Route::get(
            '/citas',
            [
                AdminCitaController::class,
                'index'
            ]
        )->name('citas.index');


        Route::get(
            '/citas/{cita}',
            [
                AdminCitaController::class,
                'show'
            ]
        )->name('citas.show');


        Route::patch(
            '/citas/{cita}/estado',
            [
                AdminCitaController::class,
                'estado'
            ]
        )->name('citas.estado');


        /*
        |------------------------------------------------------
        | Formularios
        |------------------------------------------------------
        */

        Route::get(
            '/formularios',
            [
                AdminFormularioController::class,
                'index'
            ]
        )->name('formularios.index');


        Route::get(
            '/formularios/importar',
            [
                AdminFormularioController::class,
                'importar'
            ]
        )->name(
            'formularios.importar'
        );


        Route::post(
            '/formularios/importar',
            [
                AdminFormularioController::class,
                'importarStore'
            ]
        )->name(
            'formularios.importar.store'
        );


        Route::get(
            '/formularios/{formulario}',
            [
                AdminFormularioController::class,
                'show'
            ]
        )->name(
            'formularios.show'
        );


        Route::get(
            '/formularios/{formulario}/exportar',
            [
                AdminFormularioController::class,
                'exportar'
            ]
        )->name(
            'formularios.exportar'
        );

    });