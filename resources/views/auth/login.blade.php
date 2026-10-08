<!DOCTYPE html>

<html lang="es">

<head>
    @include('partials.head')
</head>

<body>

<div class="login-page">


    <section class="login-information">

        <a
            href="{{ route('home') }}"
            class="login-brand"
        >

            <span class="brand-logo">
                N
            </span>

            <span>
                NutriVida
            </span>

        </a>


        <div>

            <span class="eyebrow eyebrow-light">
                Panel administrativo
            </span>

            <h1>
                Organiza tus citas y expedientes desde un solo lugar
            </h1>

            <p>
                Consulta las citas registradas, actualiza su estado
                y revisa la información nutricional de tus pacientes.
            </p>


            <div class="login-features">

                <span>
                    ✓ Administración de citas
                </span>

                <span>
                    ✓ Expedientes digitales
                </span>

                <span>
                    ✓ Importación y exportación TXT
                </span>

            </div>

        </div>


        <small>
            © {{ date('Y') }} NutriVida
        </small>

    </section>



    <main class="login-main">

        <div class="login-card">

            <div class="login-icon">
                🔐
            </div>


            <h2>
                Inicio de sesión
            </h2>

            <p class="muted">
                Acceso exclusivo para el nutriólogo.
            </p>


            @include('partials.mensajes')


            <form
                action="{{ route('login.post') }}"
                method="POST"
                data-once-form
            >

                @csrf


                <div class="form-group">

                    <label for="correo">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        value="{{ old('correo') }}"
                        autocomplete="username"
                        required
                        autofocus
                    >

                    @error('correo')

                        <span class="field-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <div class="form-group">

                    <label for="password">
                        Contraseña
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-password-toggle="password"
                            aria-label="Mostrar contraseña"
                        >
                            👁
                        </button>

                    </div>


                    @error('password')

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
                    Iniciar sesión
                </button>

            </form>


            @if (app()->environment('local'))

                <div class="development-data">

                    <strong>
                        Usuario de prueba
                    </strong>

                    <span>
                        nutriologo@consultorio.com
                    </span>

                    <span>
                        Nutriologo2026!
                    </span>

                </div>

            @endif


            <a
                href="{{ route('home') }}"
                class="back-link"
            >
                ← Volver al sitio público
            </a>

        </div>

    </main>

</div>

</body>

</html>