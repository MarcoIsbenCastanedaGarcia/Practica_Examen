@extends('layouts.publico')


@section('title', 'Inicio')


@section('content')


{{-- =====================================================
     HERO
====================================================== --}}

<section
    class="hero"
    id="inicio"
>

    <div class="hero-content">

        <span class="eyebrow">
            Alimentación · Salud · Bienestar
        </span>

        <h1>
            Alimenta tu bienestar,
            transforma tus hábitos
        </h1>

        <p>
            Te ayudamos a construir una alimentación equilibrada,
            práctica y adaptada a tus necesidades mediante
            orientación nutricional profesional.
        </p>

        <div class="hero-actions">

            <a
                href="#cita"
                class="btn"
            >
                Agendar una cita
            </a>

            <a
                href="#servicios"
                class="btn btn-outline"
            >
                Conocer servicios
            </a>

        </div>

    </div>


    <div
        class="hero-visual"
        aria-hidden="true"
    >

        <div class="nutrition-circle">

            <span>
                🥗
            </span>

            <strong>
                Nutrición
            </strong>

            <small>
                para una vida saludable
            </small>

        </div>

    </div>

</section>



{{-- =====================================================
     NOSOTROS
====================================================== --}}

<section
    class="section"
    id="nosotros"
>

    <div class="section-heading">

        <span class="eyebrow">
            Sobre nosotros
        </span>

        <h2>
            Acompañamiento nutricional profesional
        </h2>

    </div>


    <div class="about-grid">

        <article class="card">

            <div class="big-icon">
                👨‍⚕️
            </div>

            <h3>
                Nuestro nutriólogo
            </h3>

            <p>
                El Lic. Daniel Hernández es profesional en nutrición
                enfocado en ayudar a sus pacientes a mejorar sus
                hábitos alimenticios de forma sostenible.
            </p>

            <p>
                Cada consulta se adapta a las necesidades,
                objetivos y características particulares de
                cada paciente.
            </p>

        </article>


        <article class="card">

            <div class="big-icon">
                🎯
            </div>

            <h3>
                Nuestro objetivo
            </h3>

            <p>
                Promover una relación saludable con los alimentos
                mediante recomendaciones realistas y planes que
                puedan mantenerse a largo plazo.
            </p>

        </article>


        <article class="card">

            <div class="big-icon">
                🌿
            </div>

            <h3>
                Atención personalizada
            </h3>

            <p>
                La valoración permite conocer tus hábitos,
                objetivos y antecedentes para brindarte una
                orientación adecuada a tu situación.
            </p>

        </article>

    </div>

</section>



{{-- =====================================================
     SERVICIOS
====================================================== --}}

<section
    class="section section-soft"
    id="servicios"
>

    <div class="section-heading">

        <span class="eyebrow">
            Servicios
        </span>

        <h2>
            ¿Cómo podemos ayudarte?
        </h2>

        <p>
            Conoce algunos de los servicios disponibles
            en nuestro consultorio.
        </p>

    </div>


    <div class="services-grid">

        @forelse ($servicios as $servicio)

            <article class="service-card">

                <div class="service-icon">
                    🍏
                </div>

                <h3>
                    {{ $servicio->nombre }}
                </h3>

                <p>
                    {{ $servicio->descripcion }}
                </p>


                <div class="service-data">

                    @if ($servicio->duracion_minutos)

                        <span>
                            ⏱
                            {{ $servicio->duracion_minutos }}
                            minutos
                        </span>

                    @endif


                    @if ($servicio->precio)

                        <strong>
                            ${{ number_format($servicio->precio, 2) }}
                        </strong>

                    @endif

                </div>


                <a
                    href="#cita"
                    class="btn btn-sm"
                >
                    Solicitar cita
                </a>

            </article>

        @empty

            <article class="card">

                <p class="empty">
                    Próximamente publicaremos nuestros servicios.
                </p>

            </article>

        @endforelse

    </div>

</section>



{{-- =====================================================
     BENEFICIOS
====================================================== --}}

<section class="section">

    <div class="section-heading">

        <span class="eyebrow">
            Beneficios
        </span>

        <h2>
            Una atención organizada y sencilla
        </h2>

    </div>


    <div class="benefits-grid">

        <article class="benefit">

            <span>
                📅
            </span>

            <h3>
                Agenda fácilmente
            </h3>

            <p>
                Solicita tu cita directamente desde esta
                página sin tener que registrarte.
            </p>

        </article>


        <article class="benefit">

            <span>
                📝
            </span>

            <h3>
                Formulario digital
            </h3>

            <p>
                Completa tu información nutricional sin
                necesidad de utilizar formatos impresos.
            </p>

        </article>


        <article class="benefit">

            <span>
                🔐
            </span>

            <h3>
                Administración privada
            </h3>

            <p>
                El acceso al panel administrativo está
                reservado para el nutriólogo.
            </p>

        </article>

    </div>

</section>



{{-- =====================================================
     AGENDAR CITA
====================================================== --}}

<section
    class="section appointment-section"
    id="cita"
>

    <div class="appointment-info">

        <span class="eyebrow">
            Agenda tu consulta
        </span>

        <h2>
            Solicita una cita
        </h2>

        <p>
            Registra tus datos y selecciona el día y horario
            en que deseas asistir.
        </p>

        <div class="info-box">

            <strong>
                Importante
            </strong>

            <p>
                El sistema no permite registrar dos citas
                exactamente en la misma fecha y horario.
            </p>

        </div>


        <div class="contact-mini">

            <p>
                📞 55 1234 5678
            </p>

            <p>
                ✉ contacto@nutrivida.com
            </p>

        </div>

    </div>


    <div class="appointment-form">

        <form
            action="{{ route('citas.store') }}"
            method="POST"
            data-once-form
        >

            @csrf


            <div class="form-grid">

                <div class="form-group">

                    <label for="nombre_paciente">
                        Nombre completo *
                    </label>

                    <input
                        type="text"
                        id="nombre_paciente"
                        name="nombre_paciente"
                        value="{{ old('nombre_paciente') }}"
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

                    <label for="telefono">
                        Teléfono *
                    </label>

                    <input
                        type="tel"
                        id="telefono"
                        name="telefono"
                        value="{{ old('telefono') }}"
                        maxlength="25"
                        required
                    >

                    @error('telefono')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="correo">
                        Correo electrónico *
                    </label>

                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        value="{{ old('correo') }}"
                        maxlength="150"
                        required
                    >

                    @error('correo')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="servicio_id">
                        Servicio
                    </label>

                    <select
                        id="servicio_id"
                        name="servicio_id"
                    >

                        <option value="">
                            Selecciona un servicio
                        </option>

                        @foreach ($servicios as $servicio)

                            <option
                                value="{{ $servicio->id }}"
                                @selected(
                                    old('servicio_id') == $servicio->id
                                )
                            >
                                {{ $servicio->nombre }}
                            </option>

                        @endforeach

                    </select>

                    @error('servicio_id')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="fecha">
                        Fecha *
                    </label>

                    <input
                        type="date"
                        id="fecha"
                        name="fecha"
                        value="{{ old('fecha') }}"
                        min="{{ now()->toDateString() }}"
                        required
                    >

                    @error('fecha')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="hora">
                        Hora *
                    </label>

                    <input
                        type="time"
                        id="hora"
                        name="hora"
                        value="{{ old('hora') }}"
                        required
                    >

                    @error('hora')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="form-group full">

                    <label for="motivo">
                        Motivo de consulta *
                    </label>

                    <textarea
                        id="motivo"
                        name="motivo"
                        rows="5"
                        maxlength="2000"
                        required
                    >{{ old('motivo') }}</textarea>

                    @error('motivo')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            <button
                type="submit"
                class="btn btn-block"
                data-once
            >
                Registrar cita
            </button>

        </form>

    </div>

</section>



{{-- =====================================================
     FORMULARIO DIGITAL
====================================================== --}}

<section class="section form-promo">

    <div>

        <span class="eyebrow">
            Expediente nutricional
        </span>

        <h2>
            Formulario digital
        </h2>

        <p>
            El formulario permite registrar información
            relevante para la valoración nutricional.
        </p>

    </div>


    <a
        href="{{ route('formulario.create') }}"
        class="btn"
    >
        Abrir formulario
    </a>

</section>



{{-- =====================================================
     CONTACTO
====================================================== --}}

<section
    class="section section-soft"
    id="contacto"
>

    <div class="section-heading">

        <span class="eyebrow">
            Contacto
        </span>

        <h2>
            Estamos para ayudarte
        </h2>

    </div>


    <div class="contact-grid">

        <article class="card">

            <h3>
                Dirección
            </h3>

            <p>
                Avenida Salud No. 123,
                Texcoco, Estado de México.
            </p>

        </article>


        <article class="card">

            <h3>
                Teléfono
            </h3>

            <p>
                55 1234 5678
            </p>

        </article>


        <article class="card">

            <h3>
                Correo
            </h3>

            <p>
                contacto@nutrivida.com
            </p>

        </article>

    </div>

</section>


@endsection