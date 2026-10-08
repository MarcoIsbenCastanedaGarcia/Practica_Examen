<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<meta
    name="description"
    content="Consultorio de nutrición. Agenda citas y consulta nuestros servicios."
>

<title>
    @yield('title', 'Consultorio Nutricional')
    ·
    {{ config('app.name', 'Consultorio Nutricional') }}
</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
>

<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet"
>

@vite([
    'resources/css/app.css',
    'resources/js/app.js'
])