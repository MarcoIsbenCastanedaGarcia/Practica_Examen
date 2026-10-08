@extends('layouts.admin')


@section('title', 'Detalle de cita')


@section('content')


<div class="page-heading">

    <div>

        <span class="eyebrow">
            Cita #{{ $cita->id }}
        </span>

        <h1>
            {{ $cita->nombre_paciente }}
        </h1>

        <p>
            Información completa de la cita registrada.
        </p>

    </div>


    <a
        href="{{ route('admin.citas.index') }}"
        class="btn btn-outline"
    >
        ← Regresar
    </a>

</div>



<div class="details-layout">


    <section class="card">

        <div class="card-heading">

            <div>

                <h2>
                    Datos de la cita
                </h2>

            </div>


            <span
                class="status status-{{ $cita->estado }}"
            >
                {{ ucfirst($cita->estado) }}
            </span>

        </div>


        <dl class="detail-grid">

            <div>

                <dt>
                    Paciente
                </dt>

                <dd>
                    {{ $cita->nombre_paciente }}
                </dd>

            </div>


            <div>

                <dt>
                    Teléfono
                </dt>

                <dd>
                    {{ $cita->telefono }}
                </dd>

            </div>


            <div>

                <dt>
                    Correo
                </dt>

                <dd>
                    {{ $cita->correo }}
                </dd>

            </div>


            <div>

                <dt>
                    Fecha
                </dt>

                <dd>
                    {{ $cita->fecha->format('d/m/Y') }}
                </dd>

            </div>


            <div>

                <dt>
                    Hora
                </dt>

                <dd>

                    {{ \Carbon\Carbon::parse(
                        $cita->hora
                    )->format('H:i') }}

                </dd>

            </div>


            <div>

                <dt>
                    Servicio
                </dt>

                <dd>
                    {{ $cita->servicio?->nombre ?? 'Sin especificar' }}
                </dd>

            </div>

        </dl>


        <div class="detail-text">

            <strong>
                Motivo de consulta
            </strong>

            <p>
                {{ $cita->motivo }}
            </p>

        </div>

    </section>



    <aside class="card">

        <h2>
            Cambiar estado
        </h2>

        <p class="muted">
            Selecciona el estado actual de la cita.
        </p>


        <form
            action="{{ route(
                'admin.citas.estado',
                $cita
            ) }}"
            method="POST"
        >

            @csrf

            @method('PATCH')


            <div class="form-group">

                <label for="estado">
                    Estado
                </label>

                <select
                    id="estado"
                    name="estado"
                    required
                >

                    <option
                        value="pendiente"
                        @selected(
                            $cita->estado === 'pendiente'
                        )
                    >
                        Pendiente
                    </option>

                    <option
                        value="confirmada"
                        @selected(
                            $cita->estado === 'confirmada'
                        )
                    >
                        Confirmada
                    </option>

                    <option
                        value="cancelada"
                        @selected(
                            $cita->estado === 'cancelada'
                        )
                    >
                        Cancelada
                    </option>

                </select>

            </div>


            <button
                type="submit"
                class="btn btn-block"
            >
                Actualizar estado
            </button>

        </form>


        <hr class="separator">


        <h3>
            Formulario nutricional
        </h3>


        @if ($cita->formulario)

            <p>
                El paciente ya cuenta con formulario
                registrado.
            </p>

            <a
                href="{{ route(
                    'admin.formularios.show',
                    $cita->formulario
                ) }}"
                class="btn btn-outline btn-block"
            >
                Ver formulario
            </a>

        @else

            <p class="muted">
                Todavía no existe un formulario relacionado
                con esta cita.
            </p>

        @endif

    </aside>

</div>


@endsection