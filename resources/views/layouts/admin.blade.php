<!DOCTYPE html>

<html lang="es">

<head>
    @include('partials.head')
</head>

<body>

<div class="admin-app">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <header class="admin-header">

        <div class="header-left">

            <button
                type="button"
                class="menu-button admin-menu-button"
                data-admin-menu
                aria-label="Abrir menú"
                aria-expanded="false"
            >
                ☰
            </button>


            <a
                href="{{ route('admin.dashboard') }}"
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
                        Administración
                    </small>

                </div>

            </a>

        </div>


        <div class="admin-user">

            <div>

                <strong>
                    {{ auth()->user()->nombre }}
                </strong>

                <small>
                    Nutriólogo
                </small>

            </div>


            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="btn btn-outline btn-sm"
                >
                    Cerrar sesión
                </button>

            </form>

        </div>

    </header>



    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside
        class="admin-sidebar"
        data-admin-sidebar
    >

        <nav>

            <p class="nav-title">
                Administración
            </p>


            <a
                href="{{ route('admin.dashboard') }}"
                class="admin-nav-link
                {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >
                <span>
                    🏠
                </span>

                Panel
            </a>


            <a
                href="{{ route('admin.citas.index') }}"
                class="admin-nav-link
                {{ request()->routeIs('admin.citas.*') ? 'active' : '' }}"
            >
                <span>
                    📅
                </span>

                Citas
            </a>


            <a
                href="{{ route('admin.formularios.index') }}"
                class="admin-nav-link
                {{ request()->routeIs('admin.formularios.index', 'admin.formularios.show') ? 'active' : '' }}"
            >
                <span>
                    📋
                </span>

                Formularios
            </a>


            <a
                href="{{ route('admin.formularios.importar') }}"
                class="admin-nav-link
                {{ request()->routeIs('admin.formularios.importar*') ? 'active' : '' }}"
            >
                <span>
                    📥
                </span>

                Importar TXT
            </a>


            <p class="nav-title nav-title-second">
                Sitio
            </p>


            <a
                href="{{ route('home') }}"
                class="admin-nav-link"
                target="_blank"
            >
                <span>
                    🌐
                </span>

                Ver sitio público
            </a>

        </nav>


        <div class="sidebar-bottom">

            <p>
                Sistema de citas y valoración nutricional
            </p>

            <small>
                Laravel 13
            </small>

        </div>

    </aside>



    {{-- =====================================================
         ARTICLE
    ====================================================== --}}

    <main class="admin-main">

        <article>

            @include('partials.mensajes')

            @yield('content')

        </article>

    </main>



    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <footer class="admin-footer">

        © {{ date('Y') }}
        NutriVida · Sistema administrativo

    </footer>

</div>

</body>

</html>