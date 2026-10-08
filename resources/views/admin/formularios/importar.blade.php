@extends('layouts.admin')


@section('title', 'Importar formulario')


@section('content')


<div class="page-heading">

    <div>

        <span class="eyebrow">
            Importar información
        </span>

        <h1>
            Importar formulario TXT
        </h1>

        <p>
            Selecciona un archivo TXT generado por el sistema.
        </p>

    </div>


    <a
        href="{{ route('admin.formularios.index') }}"
        class="btn btn-outline"
    >
        ← Regresar
    </a>

</div>



<div class="import-layout">

    <section class="card">

        <div class="upload-zone">

            <span class="upload-icon">
                📄
            </span>

            <h2>
                Seleccionar archivo TXT
            </h2>

            <p>
                Tamaño máximo permitido: 2 MB.
            </p>


            <form
                action="{{ route(
                    'admin.formularios.importar.store'
                ) }}"
                method="POST"
                enctype="multipart/form-data"
                data-once-form
            >

                @csrf


                <div class="form-group">

                    <label for="archivo">
                        Archivo
                    </label>

                    <input
                        type="file"
                        id="archivo"
                        name="archivo"
                        accept=".txt,text/plain"
                        data-txt-file
                        required
                    >

                    <span
                        class="field-error"
                        data-file-error
                    ></span>

                    @error('archivo')

                        <span class="field-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <button
                    type="submit"
                    class="btn btn-block"
                    data-once
                >
                    Importar formulario
                </button>

            </form>

        </div>

    </section>



    <aside class="card">

        <h2>
            ¿Cómo funciona?
        </h2>

        <p>
            El sistema puede exportar los expedientes
            registrados en formato TXT.
        </p>

        <p>
            Posteriormente esos archivos pueden volver
            a importarse desde esta página.
        </p>


        <div class="info-box">

            <strong>
                Recomendación
            </strong>

            <p>
                Utiliza archivos exportados por este mismo
                sistema para conservar correctamente la
                estructura de los datos.
            </p>

        </div>

    </aside>

</div>


@endsection