{{-- reseña/form.blade.php --}}
    
    {{-- Campo oculto solo si $pelicula está definida --}}
    @if(isset($pelicula))
        <input type="hidden" name="pelicula_id" value="{{ $pelicula->id }}">
    @endif

    <div class="form-group mb-3">
        <label for="contenido_reseña"><strong>Reseña / Comentario</strong></label>
        <textarea id="contenido_reseña" name="contenido" class="form-control @error('contenido') is-invalid @enderror" rows="4" required>{{ old('contenido', $reseña->contenido ?? '') }}</textarea>
        @error('contenido')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="calificacion_reseña"><strong>Calificación (1 a 10)</strong></label>
        <input type="number" id="calificacion_reseña" name="calificacion" class="form-control @error('calificacion') is-invalid @enderror"
            min="1" max="10" value="{{ old('calificacion', $reseña->calificacion ?? '') }}" required>
        @error('calificacion')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group text-center mt-4">
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>