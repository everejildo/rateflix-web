<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/home') }}">
                    RateFlix
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Crear Cuenta') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('peliculas.index') }}">Añadir Película</a>
                            </li>
                            <li class="nav-item">
                                </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown-container">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle username-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item dropdown-link" href="{{ route('perfil') }}">
                                            Perfil
                                        </a>
                                        <a class="dropdown-item dropdown-link" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar Sesión') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <style>
        .navbar-nav .nav-link:hover {
            color: blue; /* Cambia el color del texto a azul al hacer hover */
            background-color: transparent; /* Mantiene el fondo transparente */
            /* Puedes agregar otras propiedades como text-decoration */
        }

        /* Estilos para el contenedor del dropdown (opcional) */
        .dropdown-container {
            position: relative; /* Necesario si quieres posicionar elementos dentro */
        }

        /* Estilos para el nombre de usuario */
        .username-dropdown {
            /* Puedes agregar estilos adicionales aquí si lo deseas */
        }

        /* Estilos de hover para los elementos del dropdown (Perfil y Cerrar Sesión) */
        .dropdown-link:hover {
            background-color: #f8f9fa; /* Un gris claro de Bootstrap como ejemplo */
            color: #007bff; /* Un azul de Bootstrap como ejemplo para el texto */
            text-decoration: none; /* Opcional: quitar el subrayado predeterminado de los enlaces */
        }

        /* Estilos de hover para el enlace del nombre de usuario (opcional) */
        .username-dropdown:hover {
            /* Puedes agregar un ligero cambio de color o fondo aquí si lo deseas */
            color: #0056b3; /* Un azul más oscuro al hacer hover en el nombre */
        }
    </style>
</body>
</html>