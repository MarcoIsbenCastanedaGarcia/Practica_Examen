<!DOCTYPE html>

<html lang="es">

<head>
    @include('partials.head')
</head>

<body>

<div class="public-app">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <header class="public-header">

        <a
            href="{{ route('home') }}"
            class="brand"
        >
            <span class="brand-logo">
                N
            </span>

            <div>
                <strong>
                    NutriVida
                </strong>

                <small>
                    Consultorio Nutricional
                </small>
            </div>
        </a>


        <button
            type="button"
            class="menu-button"
            data-public-menu
            aria-label="Abrir menú"
            aria-expanded="false"
        >
            ☰
        </button>


        <nav
            class="public-nav"
            data-public-nav
        >
            <a href="{{ route('home') }}#inicio">
                Inicio
            </a>

            <a href="{{ route('home') }}#nosotros">
                Nosotros
            </a>

            <a href="{{ route('home') }}#servicios">
                Servicios
            </a>

            <a href="{{ route('home') }}#cita">
                Agendar cita
            </a>

            <a href="{{ route('formulario.create') }}">
                Formulario
            </a>

            <a
                href="{{ route('login') }}"
                class="nav-login"
            >
                Nutriólogo
            </a>
        </nav>

    </header>


    {{-- =====================================================
         CONTENIDO
    ====================================================== --}}

    <div class="public-layout">

        <aside class="public-sidebar">

            <div class="sidebar-card">

                <span class="sidebar-icon">
                    🥑
                </span>

                <h2>
                    Tu bienestar comienza con pequeños cambios
                </h2>

                <p>
                    Recibe orientación nutricional profesional
                    mediante un plan adaptado a tus objetivos y
                    estilo de vida.
                </p>

                <a
                    href="{{ route('home') }}#cita"
                    class="btn btn-block"
                >
                    Agendar cita
                </a>

            </div>


            <div class="sidebar-card">

                <h3>
                    Horario
                </h3>

                <p>
                    Lunes a viernes
                </p>

                <strong>
                    9:00 a.m. – 6:00 p.m.
                </strong>

                <hr>

                <p>
                    Sábado
                </p>

                <strong>
                    9:00 a.m. – 2:00 p.m.
                </strong>

            </div>


            <div class="sidebar-card">

                <h3>
                    Contacto
                </h3>

                <p>
                    📞 55 1234 5678
                </p>

                <p>
                    ✉ contacto@nutrivida.com
                </p>

                <p>
                    📍 Texcoco, Estado de México
                </p>

            </div>

        </aside>


        <main class="public-main">

            <article>

                @include('partials.mensajes')

                @yield('content')

            </article>

        </main>

    </div>


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <footer class="public-footer">

        <div>

            <strong>
                NutriVida
            </strong>

            <p>
                Consultorio de nutrición y bienestar.
            </p>

        </div>


        <div>

            <strong>
                Navegación
            </strong>

            <p>
                Servicios · Citas · Formulario
            </p>

        </div>


        <div>

            <strong>
                Proyecto escolar
            </strong>

            <p>
                Laravel 13 · {{ date('Y') }}
            </p>

        </div>

    </footer>

</div>

</body>

</html>