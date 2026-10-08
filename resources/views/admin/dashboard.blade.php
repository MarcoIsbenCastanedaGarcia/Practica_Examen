@extends('layouts.admin')


@section('title', 'Panel administrativo')


@section('content')


<div class="page-heading">

    <div>

        <span class="eyebrow">
            Panel administrativo
        </span>

        <h1>
            Hola, {{ auth()->user()->nombre }}
        </h1>

        <p>
            Aquí puedes consultar el estado general
            de las citas y formularios registrados.
        </p>

    </div>


    <div class="page-actions">

        <a
            href="{{ route('admin.citas.index') }}"
            class="btn"
        >
            Ver citas
        </a>

        <a
            href="{{ route('admin.formularios.index') }}"
            class="btn btn-outline"
        >
            Ver formularios
        </a>

    </div>

</div>



<section class="stats-grid">

    <article class="stat-card">

        <span class="stat-icon">
            ⏳
        </span>

        <div>

            <span class="stat-value">
                {{ $pendientes }}
            </span>

            <span class="stat-label">
                Citas pendientes
            </span>

        </div>

    </article>


    <article class="stat-card">

        <span class="stat-icon">
            ✓
        </span>

        <div>

            <span class="stat-value">
                {{ $confirmadas }}
            </span>

            <span class="stat-label">
                Citas confirmadas
            </span>

        </div>

    </article>


    <article class="stat-card">

        <span class="stat-icon">
            ×
        </span>

        <div>

            <span class="stat-value">
                {{ $canceladas }}
            </span>

            <span class="stat-label">
                Citas canceladas
            </span>

        </div>

    </article>


    <article class="stat-card">

        <span class="stat-icon">
            📋
        </span>

        <div>

            <span class="stat-value">
                {{ $formularios }}
            </span>

            <span class="stat-label">
                Formularios
            </span>

        </div>

    </article>

</section>



<section class="card">

    <div class="card-heading">

        <div>

            <h2>
                Próximas citas
            </h2>

            <p>
                Las siguientes consultas programadas.
            </p>

        </div>


        <a
            href="{{ route('admin.citas.index') }}"
            class="btn btn-outline btn-sm"
        >
            Ver todas
        </a>

    </div>


    @if ($proximas->isEmpty())

        <div class="empty">

            <span>
                📅
            </span>

            <p>
                No hay próximas citas registradas.
            </p>

        </div>

    @else

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Paciente
                        </th>

                        <th>
                            Fecha
                        </th>

                        <th>
                            Hora
                        </th>

                        <th>
                            Servicio
                        </th>

                        <th>
                            Estado
                        </th>

                        <th>
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($proximas as $cita)

                        <tr>

                            <td>

                                <strong>
                                    {{ $cita->nombre_paciente }}
                                </strong>

                            </td>


                            <td>
                                {{ $cita->fecha->format('d/m/Y') }}
                            </td>


                            <td>

                                {{ \Carbon\Carbon::parse(
                                    $cita->hora
                                )->format('H:i') }}

                            </td>


                            <td>

                                {{ $cita->servicio?->nombre ?? 'Sin especificar' }}

                            </td>


                            <td>

                                <span
                                    class="status status-{{ $cita->estado }}"
                                >
                                    {{ ucfirst($cita->estado) }}
                                </span>

                            </td>


                            <td class="text-right">

                                <a
                                    href="{{ route(
                                        'admin.citas.show',
                                        $cita
                                    ) }}"
                                    class="btn btn-outline btn-sm"
                                >
                                    Ver
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</section>


@endsection