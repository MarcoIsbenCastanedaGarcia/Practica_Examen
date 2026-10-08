@extends('layouts.admin')


@section('title', 'Citas')


@section('content')


<div class="page-heading">

    <div>

        <span class="eyebrow">
            Administración
        </span>

        <h1>
            Citas registradas
        </h1>

        <p>
            Consulta los datos de tus pacientes y modifica
            el estado de sus citas.
        </p>

    </div>

</div>



<section class="card">

    <div class="toolbar">

        <div class="search-box">

            <input
                type="search"
                placeholder="Buscar paciente, correo o teléfono..."
                data-filter-table="tabla-citas"
            >

        </div>


        <form
            method="GET"
            action="{{ route('admin.citas.index') }}"
            class="filter-form"
        >

            <label for="estado">
                Estado:
            </label>

            <select
                id="estado"
                name="estado"
                onchange="this.form.submit()"
            >

                <option value="">
                    Todos
                </option>

                <option
                    value="pendiente"
                    @selected(
                        request('estado') === 'pendiente'
                    )
                >
                    Pendiente
                </option>

                <option
                    value="confirmada"
                    @selected(
                        request('estado') === 'confirmada'
                    )
                >
                    Confirmada
                </option>

                <option
                    value="cancelada"
                    @selected(
                        request('estado') === 'cancelada'
                    )
                >
                    Cancelada
                </option>

            </select>

        </form>

    </div>



    @if ($citas->isEmpty())

        <div class="empty">

            <span>
                📅
            </span>

            <p>
                No existen citas con los filtros seleccionados.
            </p>

        </div>

    @else

        <div class="table-wrapper">

            <table id="tabla-citas">

                <thead>

                    <tr>

                        <th>
                            Paciente
                        </th>

                        <th>
                            Contacto
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
                            Formulario
                        </th>

                        <th>
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($citas as $cita)

                        <tr>

                            <td>

                                <strong>
                                    {{ $cita->nombre_paciente }}
                                </strong>

                                <small class="table-subtitle">
                                    #{{ $cita->id }}
                                </small>

                            </td>


                            <td>

                                <span>
                                    {{ $cita->telefono }}
                                </span>

                                <small class="table-subtitle">
                                    {{ $cita->correo }}
                                </small>

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


                            <td>

                                @if ($cita->formulario)

                                    <span class="yes-badge">
                                        ✓ Registrado
                                    </span>

                                @else

                                    <span class="no-badge">
                                        Pendiente
                                    </span>

                                @endif

                            </td>


                            <td>

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



        <div class="pagination-simple">

            @if ($citas->onFirstPage())

                <span class="pagination-disabled">
                    ← Anterior
                </span>

            @else

                <a
                    href="{{ $citas->previousPageUrl() }}"
                    class="btn btn-outline btn-sm"
                >
                    ← Anterior
                </a>

            @endif


            <span>

                Página
                {{ $citas->currentPage() }}
                de
                {{ $citas->lastPage() }}

            </span>


            @if ($citas->hasMorePages())

                <a
                    href="{{ $citas->nextPageUrl() }}"
                    class="btn btn-outline btn-sm"
                >
                    Siguiente →
                </a>

            @else

                <span class="pagination-disabled">
                    Siguiente →
                </span>

            @endif

        </div>

    @endif

</section>


@endsection