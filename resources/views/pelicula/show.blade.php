@extends('layouts.app')  

@section('template_title')
    {{ $pelicula->name ?? __('Show') . " " . __('Pelicula') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: flex-end; align-items: center; gap: 10px;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Detalles') }} de la Película</span>
                        </div>
                    
                        <!-- FAVORITO -->
                        @auth
                            <form method="POST" action="{{ route('pelicula.favorito', $pelicula->id) }}">
                                @csrf
                                <button type="submit" class="custom-header-button">
                                    @if(Auth::user()->favoritos->contains($pelicula))
                                        ❌ Favorito
                                    @else
                                        🤍 Favorito
                                    @endif
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="custom-header-button">
                                Inicia sesión para agregar a favoritos
                            </a>
                        @endauth

                        <!-- COMENTARIO -->
                        @auth
                            <a href="{{ route('comentarios.createDesdePelicula', ['id' => $pelicula->id]) }}" class="custom-header-button">
                                Agregar Reseña
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="custom-header-button">
                                Inicia sesión para agregar reseña 
                            </a>
                        @endauth

                        <!-- REGRESAR -->
                        <a href="{{ url('/home') }}" class="custom-header-button">Regresar</a>

                    </div>

                    <div class="card-body bg-white">
                        <!-- Mostrar la foto de la película -->
                        <div class="form-group mb-2 mb20">
                            <strong></strong>
                            @if ($pelicula->foto)
                                <img src="{{ Storage::url($pelicula->foto) }}" alt="Foto de la película" width="200">
                            @else
                                <span>No disponible</span>
                            @endif
                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong>Titulo:</strong>
                            {{ $pelicula->titulo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Género:</strong>
                            {{ $pelicula->genero }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Año:</strong>
                            {{ $pelicula->año }}
                        </div>
                    </div>
                </div>

                {{-- Mostrar comentarios relacionados --}}
                @if($pelicula->comentarios && $pelicula->comentarios->count())
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Comentarios</h5>
                        </div>
                        <div class="card-body">
                            @foreach($pelicula->comentarios as $comentario)
                                <div class="mb-3 p-3 border rounded">
                                    <p><strong>Calificación:</strong> {{ $comentario->calificacion }}/10</p>
                                    <p><strong>Reseña / Comentario:</strong> {{ $comentario->contenido }}</p>
                                    <p><small class="text-muted">Publicado por: {{ $comentario->user->name ?? 'Anónimo' }}</small></p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="card mt-4">
                        <div class="card-body">
                            <p>No hay comentarios aún para esta película.</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <style>
        .float-left {
            flex-grow: 1;
            text-align: left;
            font-size: 17px;
        }

        .custom-header-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            margin-left: 10px;
            transition: background-color 0.3s ease;
        }

        .custom-header-button:hover {
            background-color: #0056b3;
            cursor: pointer;
        }

        .card-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }
    </style>
@endsection
