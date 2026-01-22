<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="titulo" class="form-label">{{ __('Título') }}</label>
            <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo', $pelicula?->titulo) }}" id="titulo" placeholder="Título">
            {!! $errors->first('titulo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="genero" class="form-label">{{ __('Género') }}</label>
            <input type="text" name="genero" class="form-control @error('genero') is-invalid @enderror" value="{{ old('genero', $pelicula?->genero) }}" id="genero" placeholder="Género">
            {!! $errors->first('genero', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="año" class="form-label">{{ __('Año') }}</label>
            <input type="text" name="año" class="form-control @error('año') is-invalid @enderror" value="{{ old('año', $pelicula?->año) }}" id="año" placeholder="Año">
            {!! $errors->first('año', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Campo para la foto --}}
        <div class="form-group mb-2 mb20">
            <label for="foto" class="form-label">{{ __('Imagen') }}</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto">
            {!! $errors->first('foto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            @if (isset($pelicula) && $pelicula->foto)
                <div class="mt-2">
                    <img src="{{ Storage::url($pelicula->foto) }}" alt="Foto de la película" width="100">
                </div>
            @endif
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>