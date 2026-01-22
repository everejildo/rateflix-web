@extends('layouts.app')

@section('template_title')
    {{ $reseña->name ?? __('Show') . " " . __('Reseña') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Reseña</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('reseñas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Contenido:</strong>
                                <pre>
                                    {{ var_dump($reseña) }}
                                </pre>
                            {{ $reseña->contenido }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Calificación:</strong>
                            {{ $reseña->calificación }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Pelicula Id:</strong>
                            {{ $reseña->pelicula_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
