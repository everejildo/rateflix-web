@extends('layouts.app')

@section('content')
    <div class="home-container">
        <div class="header">
            <div class="profile-icon"></div>
            <div class="search-wrapper">
                <form action="{{ route('home') }}" method="GET" class="search-bar">
                    <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                    <button type="submit" class="search-icon">🔍</button>
                </form>
            </div>
        </div>

        <div class="summary-bar">Resumen</div>

        <div class="categories-bar">
            <a href="{{ route('categories') }}" class="category-button">Categorías</a>
            <a href="{{ route('peliculas.top') }}" class="category-button">Top 10</a>
            <a href="{{ route('favorites') }}" class="category-button">Favoritos</a>
        </div>

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
                    <div class="details-bar">
                        <a href="{{ route('peliculas.show', $pelicula->id) }}" class="custom-button">
                            {{ $pelicula->titulo }}
                        </a>
                    </div>
                </div>
            @empty
                <p class="no-results">No se encontraron resultados.</p>
            @endforelse
        </div>

        <!-- Paginación -->
        <div id="pagination">
            {{ $peliculas->appends(['search' => request('search')])->links() }}
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; {{ date('Y') }} RateFlix. Todos los derechos reservados.</p>
            <p>Desarrollado por RateFlix Industries</p>
            <p>🎬</p>
        </footer>
    </div>
@endsection

@section('scripts')
@endsection

<style>
    body {
        background-color: black !important;
        margin: 0;
    }

    .home-container {
        background-color: black;
        color: white;
        font-family: sans-serif;
        padding: 20px;
    }

    .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        justify-content: space-between;
    }

    .search-wrapper {
        flex-grow: 1;
        margin-left: 10px;
    }

    .profile-icon, .menu-icon {
        font-size: 24px;
    }

    .search-bar {
        display: flex;
        align-items: center;
        background-color: white;
        border-radius: 5px;
        padding: 5px;
    }

    .search-bar input {
        border: none;
        outline: none;
        padding: 5px;
        flex-grow: 1;
    }

    .search-icon {
        font-size: 20px;
        background: none;
        border: none;
        cursor: pointer;
    }

    .summary-bar {
        background-color: #333;
        padding: 10px;
        text-align: center;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .categories-bar {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
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

    .category-button:hover {
        background-color: rgb(168, 168, 168);
        color: black;
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
        width: 100%;
        background-color: transparent;
        color: white;
        padding: 8px 0;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        line-height: 1.2;
        transition: background-color 0.3s ease;
    }

    .custom-button:hover {
        background-color: rgb(189, 189, 189);
        color: black;
    }

    .details-bar {
        display: flex;
        justify-content: center;
        margin-top: 8px;
    }

    #pagination {
        margin-top: 20px;
        text-align: center;
    }

    .no-results {
        color: white;
        text-align: center;
        grid-column: 1 / -1;
    }

    nav[role="navigation"] {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding-left: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a,
    .pagination li span {
        padding: 8px 12px;
        border-radius: 5px;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .pagination li a:hover {
        background-color: #555;
    }

    .pagination li.active span {
        background-color: #007bff;
        color: white;
    }

    .pagination li.disabled span {
        color: #888;
        background-color: #222;
    }

    nav[role="navigation"] > div:not(.pagination) {
        display: none !important;
    }

    /* Footer */
    .footer {
        background-color: #111;
        color: #aaa;
        text-align: center;
        padding: 20px 10px;
        font-size: 14px;
        margin-top: 40px;
        border-top: 1px solid #333;
    }
</style>
