@extends('layouts.publico')


@section('title', 'Formulario nutricional')


@section('content')


<div class="page-heading">

    <div>

        <span class="eyebrow">
            Valoración nutricional
        </span>

        <h1>
            Formulario médico y nutricional
        </h1>

        <p>
            Completa la siguiente información para registrar
            los datos necesarios para tu consulta.
        </p>

    </div>


    <a
        href="{{ route('home') }}"
        class="btn btn-outline"
    >
        ← Regresar
    </a>

</div>



@if ($cita)

    <div class="linked-appointment">

        <strong>
            Formulario relacionado con cita:
        </strong>

        <span>
            #{{ $cita->id }}
            ·
            {{ $cita->nombre_paciente }}
            ·
            {{ $cita->fecha->format('d/m/Y') }}
            ·
            {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}
        </span>

    </div>

@endif



<section class="card form-card">

    <form
        action="{{ route('formulario.store') }}"
        method="POST"
        data-once-form
    >

        @csrf


        @if ($cita)

            <input
                type="hidden"
                name="cita_id"
                value="{{ $cita->id }}"
            >

        @else

            <div class="form-group">

                <label for="cita_id">
                    Número de cita
                </label>

                <input
                    type="number"
                    id="cita_id"
                    name="cita_id"
                    value="{{ old('cita_id') }}"
                    min="1"
                >

                <small class="help-text">
                    Déjalo vacío si todavía no cuentas
                    con una cita registrada.
                </small>

            </div>

        @endif



        <div class="form-section-title">

            <span>
                1
            </span>

            <div>

                <h2>
                    Datos personales
                </h2>

                <p>
                    Información general del paciente.
                </p>

            </div>

        </div>


        <div class="form-grid">

            <div class="form-group full">

                <label for="nombre_paciente">
                    Nombre completo *
                </label>

                <input
                    type="text"
                    id="nombre_paciente"
                    name="nombre_paciente"
                    value="{{ old(
                        'nombre_paciente',
                        $cita?->nombre_paciente
                    ) }}"
                    maxlength="120"
                    required
                >

                @error('nombre_paciente')
                    <span class="field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="form-group">

                <label for="fecha_nacimiento">
                    Fecha de nacimiento
                </label>

                <input
                    type="date"
                    id="fecha_nacimiento"
                    name="fecha_nacimiento"
                    value="{{ old('fecha_nacimiento') }}"
                    max="{{ now()->toDateString() }}"
                >

                @error('fecha_nacimiento')
                    <span class="field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="form-group">

                <label for="sexo">
                    Sexo
                </label>

                <select
                    id="sexo"
                    name="sexo"
                >

                    <option value="">
                        Selecciona
                    </option>

                    <option
                        value="Femenino"
                        @selected(
                            old('sexo') === 'Femenino'
                        )
                    >
                        Femenino
                    </option>

                    <option
                        value="Masculino"
                        @selected(
                            old('sexo') === 'Masculino'
                        )
                    >
                        Masculino
                    </option>

                    <option
                        value="Otro"
                        @selected(
                            old('sexo') === 'Otro'
                        )
                    >
                        Otro
                    </option>

                    <option
                        value="Prefiero no especificar"
                        @selected(
                            old('sexo') === 'Prefiero no especificar'
                        )
                    >
                        Prefiero no especificar
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label for="peso">
                    Peso (kg)
                </label>

                <input
                    type="number"
                    id="peso"
                    name="peso"
                    value="{{ old('peso') }}"
                    min="1"
                    max="500"
                    step="0.01"
                    placeholder="Ej. 65.5"
                >

                @error('peso')
                    <span class="field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            <div class="form-group">

                <label for="estatura">
                    Estatura (cm)
                </label>

                <input
                    type="number"
                    id="estatura"
                    name="estatura"
                    value="{{ old('estatura') }}"
                    min="30"
                    max="260"
                    step="0.01"
                    placeholder="Ej. 165"
                >

                @error('estatura')
                    <span class="field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </div>



        <div class="form-section-title">

            <span>
                2
            </span>

            <div>

                <h2>
                    Objetivos
                </h2>

                <p>
                    Cuéntanos el motivo y objetivo nutricional.
                </p>

            </div>

        </div>


        <div class="form-group">

            <label for="objetivo">
                Objetivo nutricional
            </label>

            <textarea
                id="objetivo"
                name="objetivo"
                rows="4"
                maxlength="3000"
                placeholder="Describe qué deseas lograr..."
            >{{ old('objetivo') }}</textarea>

        </div>



        <div class="form-section-title">

            <span>
                3
            </span>

            <div>

                <h2>
                    Antecedentes
                </h2>

                <p>
                    Información relevante para la valoración.
                </p>

            </div>

        </div>


        <div class="form-grid">

            <div class="form-group">

                <label for="antecedentes_personales">
                    Antecedentes personales
                </label>

                <textarea
                    id="antecedentes_personales"
                    name="antecedentes_personales"
                    rows="5"
                    maxlength="5000"
                    placeholder="Enfermedades, cirugías, condiciones..."
                >{{ old('antecedentes_personales') }}</textarea>

            </div>


            <div class="form-group">

                <label for="antecedentes_familiares">
                    Antecedentes familiares
                </label>

                <textarea
                    id="antecedentes_familiares"
                    name="antecedentes_familiares"
                    rows="5"
                    maxlength="5000"
                    placeholder="Diabetes, hipertensión, etc."
                >{{ old('antecedentes_familiares') }}</textarea>

            </div>


            <div class="form-group">

                <label for="alergias">
                    Alergias
                </label>

                <textarea
                    id="alergias"
                    name="alergias"
                    rows="4"
                    maxlength="3000"
                    placeholder="Indica alergias conocidas..."
                >{{ old('alergias') }}</textarea>

            </div>


            <div class="form-group">

                <label for="medicamentos">
                    Medicamentos
                </label>

                <textarea
                    id="medicamentos"
                    name="medicamentos"
                    rows="4"
                    maxlength="3000"
                    placeholder="Indica medicamentos actuales..."
                >{{ old('medicamentos') }}</textarea>

            </div>

        </div>



        <div class="form-section-title">

            <span>
                4
            </span>

            <div>

                <h2>
                    Hábitos
                </h2>

                <p>
                    Alimentación, ejercicio y consumo de agua.
                </p>

            </div>

        </div>


        <div class="form-grid">

            <div class="form-group full">

                <label for="habitos_alimenticios">
                    Hábitos alimenticios
                </label>

                <textarea
                    id="habitos_alimenticios"
                    name="habitos_alimenticios"
                    rows="5"
                    maxlength="5000"
                    placeholder="Describe horarios, número de comidas, alimentos frecuentes..."
                >{{ old('habitos_alimenticios') }}</textarea>

            </div>


            <div class="form-group">

                <label for="actividad_fisica">
                    Actividad física
                </label>

                <textarea
                    id="actividad_fisica"
                    name="actividad_fisica"
                    rows="4"
                    maxlength="3000"
                    placeholder="Tipo de ejercicio y frecuencia..."
                >{{ old('actividad_fisica') }}</textarea>

            </div>


            <div class="form-group">

                <label for="consumo_agua">
                    Consumo de agua
                </label>

                <input
                    type="text"
                    id="consumo_agua"
                    name="consumo_agua"
                    value="{{ old('consumo_agua') }}"
                    maxlength="100"
                    placeholder="Ej. 2 litros al día"
                >

            </div>


            <div class="form-group full">

                <label for="observaciones">
                    Observaciones adicionales
                </label>

                <textarea
                    id="observaciones"
                    name="observaciones"
                    rows="5"
                    maxlength="5000"
                >{{ old('observaciones') }}</textarea>

            </div>

        </div>



        <div class="form-actions">

            <a
                href="{{ route('home') }}"
                class="btn btn-outline"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn"
                data-once
            >
                Guardar formulario
            </button>

        </div>

    </form>

</section>


@endsection