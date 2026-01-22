@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Agregar Reseña a: <strong>{{ $pelicula->titulo }}</strong></h3>

    {{-- Mostrar errores --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <form method="POST" action="{{ route('comentarios.store', ['pelicula' => $pelicula->id]) }}">
        @csrf

        {{-- Campo oculto para ID de película --}}
        <input type="hidden" name="pelicula_id" value="{{ $pelicula->id }}">

        {{-- Campo de comentario --}}
        <div class="mb-3">
            <label for="contenido" class="form-label">Comentario</label>
            <textarea name="contenido" id="contenido" rows="4" class="form-control">{{ old('contenido') }}</textarea>
        </div>

        {{-- Campo de calificación --}}
        <div class="mb-3">
            <label for="calificacion" class="form-label">Calificación (1 a 10)</label>
            <input type="number" name="calificacion" id="calificacion" class="form-control" min="1" max="10" value="{{ old('calificacion') }}">
        </div>

        {{-- Botones --}}
        <div class="mt-3">
            <button type="submit" class="btn btn-primary custom-button">Guardar Reseña</button>
            <a href="{{ route('peliculas.show', ['pelicula' => $pelicula->id]) }}" class="btn btn-primary ms-2 custom-button">Cancelar</a>
        </div>
    </form>
</div>
@endsection

<style>
    .custom-button {
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-button:hover {
        background-color: #0056b3; /* Un tono de azul más oscuro al pasar el ratón */
    }

    /* Manteniendo el estilo primario de Bootstrap para el fondo */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>