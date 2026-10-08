@extends('layouts.admin')


@section('title', 'Formularios')


@section('content')


<div class="page-heading">

    <div>

        <span class="eyebrow">
            Expedientes
        </span>

        <h1>
            Formularios nutricionales
        </h1>

        <p>
            Consulta la información registrada de los pacientes.
        </p>

    </div>


    <a
        href="{{ route('admin.formularios.importar') }}"
        class="btn"
    >
        📥 Importar TXT
    </a>

</div>



<section class="card">

    <div class="toolbar">

        <input
            type="search"
            placeholder="Buscar paciente..."
            data-filter-table="tabla-formularios"
        >

    </div>



    @if ($formularios->isEmpty())

        <div class="empty">

            <span>
                📋
            </span>

            <p>
                Todavía no existen formularios registrados.
            </p>

        </div>

    @else

        <div class="table-wrapper">

            <table id="tabla-formularios">

                <thead>

                    <tr>

                        <th>
                            Folio
                        </th>

                        <th>
                            Paciente
                        </th>

                        <th>
                            Cita
                        </th>

                        <th>
                            Fecha de registro
                        </th>

                        <th>
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($formularios as $formulario)

                        <tr>

                            <td>
                                #{{ $formulario->id }}
                            </td>


                            <td>

                                <strong>
                                    {{ $formulario->nombre_paciente }}
                                </strong>

                            </td>


                            <td>

                                @if ($formulario->cita)

                                    #{{ $formulario->cita->id }}

                                @else

                                    Sin cita relacionada

                                @endif

                            </td>


                            <td>

                                {{ $formulario->created_at->format(
                                    'd/m/Y H:i'
                                ) }}

                            </td>


                            <td class="table-actions">

                                <a
                                    href="{{ route(
                                        'admin.formularios.show',
                                        $formulario
                                    ) }}"
                                    class="btn btn-outline btn-sm"
                                >
                                    Ver
                                </a>


                                <a
                                    href="{{ route(
                                        'admin.formularios.exportar',
                                        $formulario
                                    ) }}"
                                    class="btn btn-sm"
                                >
                                    TXT
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>



        <div class="pagination-simple">

            @if ($formularios->onFirstPage())

                <span class="pagination-disabled">
                    ← Anterior
                </span>

            @else

                <a
                    href="{{ $formularios->previousPageUrl() }}"
                    class="btn btn-outline btn-sm"
                >
                    ← Anterior
                </a>

            @endif


            <span>

                Página
                {{ $formularios->currentPage() }}
                de
                {{ $formularios->lastPage() }}

            </span>


            @if ($formularios->hasMorePages())

                <a
                    href="{{ $formularios->nextPageUrl() }}"
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