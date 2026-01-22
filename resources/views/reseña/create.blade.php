@extends('layouts.app') 

@section('template_title')
    {{ __('Crear') }} Reseña
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Agregar') }} Reseña</span>
                    </div>
                    <div class="card-body bg-white">

                        {{-- ⚠️ Mostrar alerta si no hay película --}}
                        @if(!isset($pelicula))
                            <div class="alert alert-warning">
                                No se ha seleccionado una película. No puedes agregar una reseña sin elegir una película.
                            </div>
                        @endif

                        {{-- ✅ Mostrar formulario solo si hay película --}}
                        @if(isset($pelicula))
                            <form method="POST" action="{{ route('reseñas.store') }}" role="form" enctype="multipart/form-data">
                                @csrf

                                {{-- Info de película --}}
                                <div class="alert alert-info">
                                    <strong>Película:</strong> {{ $pelicula->titulo }}
                                </div>
                                <input type="hidden" name="pelicula_id" value="{{ $pelicula->id }}">

                                @include('reseña.form', ['pelicula' => $pelicula])
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
