@extends('layouts.app')

@section('content')
<div class="favorites-container">
    <a href="{{ url('/home') }}" class="back-button">⬅️</a>
    <button class="favorites-title">Favoritos</button>

    <div class="favorites-list">
        @forelse ($favoritas as $pelicula)
            <div class="favorite-item">
                <div class="favorite-heart">
                    <form method="POST" action="{{ route('pelicula.favorito', $pelicula->id) }}">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:white; font-size:20px; padding:0; margin-right: 10px;">
                            💙
                        </button>
                    </form>
                </div>
                <div class="favorite-image">
                    @if ($pelicula->foto)
                        <img src="{{ Storage::url($pelicula->foto) }}" alt="{{ $pelicula->titulo }}" class="favorite-poster">
                    @else
                        <span>Sin imagen</span>
                    @endif
                </div>
                <div class="favorite-details">
                    <span>{{ $pelicula->titulo }}</span>
                    <a href="{{ route('peliculas.show', $pelicula->id) }}">
                        <button>Detalles</button>
                    </a>
                </div>
            </div>
        @empty
            <p>No tienes películas favoritas aún.</p>
        @endforelse
    </div>
</div>
@endsection

<style>
    body {
        background-color: black !important;
        margin: 0;
    }

    .favorites-container {
        background-color: black;
        color: white;
        font-family: sans-serif;
        padding: 20px;
    }

    .back-button {
        background-color: #555;
        color: white;
        border: none;
        padding: 13px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-decoration: none;
    }

    .back-button:hover {
        background-color:rgb(168, 168, 168);
        color: black;
    }

    .favorites-title {
        background-color: #555;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-decoration: none;
    }

    .favorites-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Ajusta el minmax según el tamaño deseado */
        gap: 15px;
    }

    .favorite-item {
        display: flex;
        flex-direction: column;
        align-items: center; /* Centra horizontalmente los elementos */
        text-align: center; /* Centra el texto dentro de los elementos */
        background-color: #333;
        padding: 15px; /* Aumenta un poco el padding para mejor espaciado */
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .favorite-heart {
        font-size: 20px;
        /* margin-right: 0; Eliminamos esto ya que vamos a centrar */
        margin-bottom: 10px;
        display: flex; /* Convertimos el contenedor del corazón en un flex container */
        justify-content: center; /* Centra el contenido (el corazón) horizontalmente */
        width: 100%; /* Ocupa todo el ancho de su contenedor (.favorite-item) para poder centrar */
    }

    .favorite-heart button {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        padding: 0;
        margin-right: 10px; /* Asegúrate de que este margen esté si lo necesitas en el diseño normal */
        cursor: pointer; /* Indica que es interactivo */
        transition: text-shadow 0.3s ease-in-out; /* Animación suave para la sombra */
    }

    .favorite-heart button:hover {
        text-shadow: 0 0 5px white; /* Agrega una sombra blanca */
    }

    .favorite-image {
        background-color: #555;
        width: 120px; /* Ancho fijo para todas las imágenes */
        height: 180px; /* Alto fijo para todas las imágenes */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .favorite-image img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Recorta la imagen para llenar el contenedor */
        border-radius: 5px;
    }

    .favorite-details {
        display: flex;
        flex-direction: column;
        align-items: center; /* Centra los elementos */
        justify-content: center; /* Centra los elementos */
        width: 100%;
    }

    .favorite-details span {
        margin-bottom: 5px;
    }

    .favorite-details button {
        background-color: #555;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* Media query para pantallas de celulares */
    @media (max-width: 768px) {
        .favorites-list {
            grid-template-columns: 1fr;
        }

        .favorite-item {
            flex-direction: row;
            align-items: center;
            text-align: left; /* Vuelve a alinear el texto a la izquierda */
        }

        .favorite-heart {
            margin-right: 10px;
            margin-bottom: 0;
            align-self: center; /* Centra el corazón verticalmente */
        }

        .favorite-image {
            width: 75px;
            height: 100px;
            margin-right: 10px;
            margin-bottom: 0;
        }

        .favorite-details {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            width: auto;
            text-align: left; /* Vuelve a alinear el texto a la izquierda */
        }

        .favorite-details span {
            margin-right: auto;
            margin-bottom: 0;
        }
    }

     /* Media query para pantallas de hasta 600px de ancho (móviles) */
    @media (max-width: 600px) {
        .favorites-title {
            font-size: 1.3em;
            margin-bottom: 15px;
        }

        .favorites-list {
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); /* Reducir el minmax para más columnas */
            gap: 10px;
        }

        .favorite-item {
            padding: 10px;
        }

        .favorite-heart {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .favorite-image {
            width: 80px;
            height: 120px;
            margin-bottom: 5px;
        }

        .favorite-details span {
            font-size: 0.9em;
            margin-bottom: 3px;
        }

        .favorite-details button {
            font-size: 0.8em;
            padding: 4px 8px;
        }
    }

    /* Media query para pantallas entre 601px y 960px de ancho (tablets) */
    @media (min-width: 601px) and (max-width: 960px) {
        .favorites-title {
            font-size: 1.4em;
        }

        .favorites-list {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); /* Ajustar minmax para tablets */
            gap: 12px;
        }

        .favorite-item {
            padding: 12px;
        }

        .favorite-heart {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .favorite-image {
            width: 100px;
            height: 150px;
            margin-bottom: 8px;
        }

        .favorite-details span {
            font-size: 1em;
            margin-bottom: 4px;
        }

        .favorite-details button {
            font-size: 0.9em;
            padding: 6px 10px;
        }
    }

        /* Media query para pantallas de hasta 768px de ancho (móviles y tablets pequeños) */
        @media (max-width: 768px) {
        .favorites-title {
            font-size: 1.3em;
            margin-bottom: 15px;
        }

        .favorites-list {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Aseguramos al menos 2 columnas */
            gap: 15px;
        }

        .favorite-item {
            padding: 10px;
            align-items: flex-start; /* Alineamos los elementos a la izquierda */
            text-align: left;
            flex-direction: row; /* Cambiamos a disposición horizontal */
            margin-bottom: 10px;
        }

        .favorite-heart {
            font-size: 18px;
            margin-bottom: 0;
            margin-right: 10px; /* Espacio entre el corazón y la imagen */
            width: auto; /* Ajustar ancho al contenido */
        }

        .favorite-image {
            width: 60px; /* Imagen más pequeña */
            height: 90px; /* Imagen más pequeña */
            margin-bottom: 0;
            margin-right: 10px; /* Espacio entre la imagen y los detalles */
        }

        .favorite-details {
            align-items: flex-start; /* Alineamos los detalles a la izquierda */
            flex-grow: 1; /* Ocupar el espacio restante */
        }

        .favorite-details span {
            font-size: 0.9em;
            margin-bottom: 3px;
        }

        .favorite-details button {
            font-size: 0.8em;
            padding: 4px 8px;
        }
    }

    /* Media query para pantallas aún más pequeñas (móviles angostos) */
    @media (max-width: 480px) {
        .favorites-list {
            grid-template-columns: 1fr; /* Una sola columna en pantallas muy pequeñas */
        }

        .favorite-item {
            flex-direction: column; /* Volvemos a disposición vertical en pantallas muy angostas */
            align-items: center;
            text-align: center;
        }

        .favorite-heart {
            margin-right: 0;
            margin-bottom: 5px;
            width: 100%;
            justify-content: center;
        }

        .favorite-image {
            margin-right: 0;
            margin-bottom: 5px;
            width: 70px;
            height: 105px;
        }

        .favorite-details {
            align-items: center;
            text-align: center;
        }
    }
</style>