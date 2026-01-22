@extends('layouts.app')

@section('content')
<div class="categories-container">
    <a href="{{ url('/home') }}" class="back-button">⬅️</a>
    <button class="category-button">Top 10 Películas Mejor Valoradas</button>

    <div class="movies-grid">
        <div class="content-grid">
            @forelse ($peliculas as $pelicula)
                <a href="{{ route('peliculas.show', $pelicula->id) }}" class="content-item-link">
                    <div class="content-item">
                        <div class="top-number">#{{ $loop->iteration }}</div>
                        <div class="image-placeholder">
                            @if ($pelicula->foto)
                                <img src="{{ Storage::url($pelicula->foto) }}" alt="{{ $pelicula->titulo }}">
                            @else
                                <span>Sin imagen</span>
                            @endif
                        </div>
                        <div class="details-bar">
                            <div class="movie-title">{{ $pelicula->titulo }}</div>
                            <p class="movie-score">Promedio: {{ number_format($pelicula->promedio, 1) }}/10.0</p>
                        </div>
                    </div>
                </a>
            @empty
                <p style="color: white;">No hay películas para mostrar.</p>
            @endforelse
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

    .movies-grid {
        flex: 1;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .content-item-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .content-item {
        display: flex;
        align-items: center;
        background-color: #333;
        padding: 15px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .content-item:hover {
        background-color: rgb(168, 168, 168);
        color: black;
    }

    .top-number {
        font-weight: bold;
        margin-right: 15px;
        font-size: 1.2em;
        min-width: 40px;
        text-align: center;
    }

    .image-placeholder {
        width: 50px;
        height: 75px;
        overflow: hidden;
        border-radius: 5px;
        margin-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #555;
    }

    .image-placeholder img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .details-bar {
        flex: 1;
    }

    .movie-title {
        font-weight: bold;
        font-size: 1em;
    }

    .movie-score {
        font-size: 0.8em;
        /* color: #aaa; */
        margin-top: 5px;
    }
</style>
