@extends('layouts.app')

@section('content')
<div class="categories-container">
    <a href="{{ url('/home') }}" class="back-button">⬅️</a>
    <button class="category-button">Categorías</button>

    <div class="content-wrapper">
        <div class="categories-list">
            @php
                $generos = ['Acción', 'Adolescente', 'Animación', 'Aventura', 'Bélico', 'Biográfica', 'Ciencia Ficción', 
                'Comedia', 'Comedia Dramática', 'Comedia Musical', 'Comedia Negra', 'Comedia Romántica', 'Crimen', 'Deportes', 
                'Documental', 'Drama', 'Drama Social', 'Familia', 'Fantasía', 'Historia', 'Metraje Encontrado', 'Misterio', 
                'Musical', 'Romance', 'Superhéroes', 'Suspenso', 'Terror', 'Terror Psicológico', 'Thriller', 'Western'];
            @endphp

            @foreach($generos as $g)
                <a href="{{ route('peliculas.porGenero', $g) }}">
                    <button class="{{ isset($genero) && $genero === $g ? 'active-category' : '' }}">
                        {{ $g }}
                    </button>
                </a>
            @endforeach
        </div>

        <div class="movies-grid">
            @if(isset($genero))
                <h2 style="text-align:center; margin: 20px 0;">Películas de: {{ $genero }}</h2>
            @endif

            <div class="content-grid">
                @forelse ($peliculas as $pelicula)
                    <div class="content-item">
                        <div class="image-placeholder">
                            @if ($pelicula->foto)
                                <img src="{{ Storage::url($pelicula->foto) }}" alt="{{ $pelicula->titulo }}">
                            @else
                                <span>Sin imagen</span>
                            @endif
                        </div>
                        <div class="details-bar" style="margin-top: 8px;">
                            <a href="{{ route('peliculas.show', $pelicula->id) }}" class="custom-button">
                                {{ $pelicula->titulo }}
                            </a>
                        </div>
                    </div>
                @empty
                    <p style="color: white;">
                        @if(isset($genero))
                            No hay películas en esta categoría.
                        @else
                            Selecciona una categoría para ver las películas.
                        @endif
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    body {
        background-color: black !important;
        margin: 0;
    }

    .categories-container {
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
        background-color: rgb(168, 168, 168);
        color: black;
    }

    .category-button {
        background-color: #555;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-decoration: none;
    }

    .content-wrapper {
        display: flex;
    }

    .categories-list {
        flex: 0 0 200px;
        margin-right: 20px;
    }

    .categories-list button {
        background-color: #333;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-bottom: 10px;
        width: 100%;
        text-align: left;
    }

    .categories-list .active-category {
        background-color: #007BFF;
        font-weight: bold;
    }

    .movies-grid {
        flex: 1;
    }

    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        text-align: center;
    }

    .content-item {
        background-color: #333;
        padding: 20px;
        border-radius: 5px;
        width: 140px;
        margin: auto;
    }

    .image-placeholder img {
        width: 100px;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
    }

    .custom-button {
        width: 100px;
        background-color: none;
        color: white;
        padding: 8px 0px;
        border-radius: 8px;
        text-decoration: none;
        text-align: center;
        line-height: 1;
        transition: background-color 0.3s ease;
    }

    .custom-button:hover {
        background-color: rgb(189, 189, 189);
        color: black;
    }

    .details-bar {
        display: flex;
        justify-content: center;
    }

</style>
