@extends('layouts.admin')


@section('title', 'Formulario nutricional')


@section('content')


<div class="page-heading">

    <div>

        <span class="eyebrow">
            Expediente #{{ $formulario->id }}
        </span>

        <h1>
            {{ $formulario->nombre_paciente }}
        </h1>

        <p>
            Información nutricional registrada.
        </p>

    </div>


    <div class="page-actions">

        <a
            href="{{ route(
                'admin.formularios.exportar',
                $formulario
            ) }}"
            class="btn"
        >
            Descargar TXT
        </a>

        <a
            href="{{ route('admin.formularios.index') }}"
            class="btn btn-outline"
        >
            ← Regresar
        </a>

    </div>

</div>



<section class="card">

    <div class="form-section-title">

        <span>
            1
        </span>

        <div>

            <h2>
                Datos personales
            </h2>

        </div>

    </div>


    <dl class="detail-grid">

        <div>

            <dt>
                Nombre
            </dt>

            <dd>
                {{ $formulario->nombre_paciente }}
            </dd>

        </div>


        <div>

            <dt>
                Fecha de nacimiento
            </dt>

            <dd>

                {{ $formulario->fecha_nacimiento
                    ? $formulario->fecha_nacimiento->format('d/m/Y')
                    : 'No especificada' }}

            </dd>

        </div>


        <div>

            <dt>
                Sexo
            </dt>

            <dd>
                {{ $formulario->sexo ?: 'No especificado' }}
            </dd>

        </div>


        <div>

            <dt>
                Peso
            </dt>

            <dd>

                {{ $formulario->peso
                    ? $formulario->peso.' kg'
                    : 'No registrado' }}

            </dd>

        </div>


        <div>

            <dt>
                Estatura
            </dt>

            <dd>

                {{ $formulario->estatura
                    ? $formulario->estatura.' cm'
                    : 'No registrada' }}

            </dd>

        </div>


        <div>

            <dt>
                Cita relacionada
            </dt>

            <dd>

                @if ($formulario->cita)

                    <a
                        href="{{ route(
                            'admin.citas.show',
                            $formulario->cita
                        ) }}"
                    >
                        Cita #{{ $formulario->cita->id }}
                    </a>

                @else

                    Sin cita relacionada

                @endif

            </dd>

        </div>

    </dl>

</section>



<section class="card">

    <div class="form-section-title">

        <span>
            2
        </span>

        <div>

            <h2>
                Objetivo
            </h2>

        </div>

    </div>


    <div class="record-text">

        {{ $formulario->objetivo ?: 'Sin información registrada.' }}

    </div>

</section>



<section class="card">

    <div class="form-section-title">

        <span>
            3
        </span>

        <div>

            <h2>
                Antecedentes
            </h2>

        </div>

    </div>


    <div class="record-grid">

        <div>

            <h3>
                Antecedentes personales
            </h3>

            <p>
                {{ $formulario->antecedentes_personales ?: 'Sin información.' }}
            </p>

        </div>


        <div>

            <h3>
                Antecedentes familiares
            </h3>

            <p>
                {{ $formulario->antecedentes_familiares ?: 'Sin información.' }}
            </p>

        </div>


        <div>

            <h3>
                Alergias
            </h3>

            <p>
                {{ $formulario->alergias ?: 'Sin información.' }}
            </p>

        </div>


        <div>

            <h3>
                Medicamentos
            </h3>

            <p>
                {{ $formulario->medicamentos ?: 'Sin información.' }}
            </p>

        </div>

    </div>

</section>



<section class="card">

    <div class="form-section-title">

        <span>
            4
        </span>

        <div>

            <h2>
                Hábitos
            </h2>

        </div>

    </div>


    <div class="record-grid">

        <div>

            <h3>
                Hábitos alimenticios
            </h3>

            <p>
                {{ $formulario->habitos_alimenticios ?: 'Sin información.' }}
            </p>

        </div>


        <div>

            <h3>
                Actividad física
            </h3>

            <p>
                {{ $formulario->actividad_fisica ?: 'Sin información.' }}
            </p>

        </div>


        <div>

            <h3>
                Consumo de agua
            </h3>

            <p>
                {{ $formulario->consumo_agua ?: 'Sin información.' }}
            </p>

        </div>


        <div>

            <h3>
                Observaciones
            </h3>

            <p>
                {{ $formulario->observaciones ?: 'Sin información.' }}
            </p>

        </div>

    </div>

</section>


@endsection