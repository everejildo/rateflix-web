{{-- Formulario de comentario --}}

<div class="form-group mb-3">
    <label for="contenido"><strong>Comentario</strong></label>
    <textarea id="contenido" name="contenido" class="form-control @error('contenido') is-invalid @enderror" rows="4" required>{{ old('contenido') }}</textarea>
    @error('contenido')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="calificacion"><strong>Calificación (1 a 10) </strong></label>
    <input type="number" name="calificacion" id="calificacion" min="0" max="10" value="{{ old('calificacion', 0) }}">
    @error('calificacion')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

{{-- Aquí va el hidden --}}
<input type="hidden" name="pelicula_id" value="{{ $pelicula->id }}">

<div class="form-group text-center mt-4">
    <button type="submit" class="btn btn-primary">Guardar Reseña</button>
</div>
