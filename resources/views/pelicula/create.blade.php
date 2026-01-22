@extends('layouts.app')

@section('template_title')
    {{ __('Crear') }} Pelicula
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Agregar') }} Película</span>
                        <div class="float-right">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                Regresar
                            </a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('peliculas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('pelicula.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px; /* Ajusta el padding vertical si es necesario */
        }

        .card-title {
            font-size: 1.25rem; /* Ajusta el tamaño del título si es necesario */
        }

        .btn-secondary {
            background-color: #6c757d; /* Color grisáceo para el botón */
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .float-left {
            margin-right: 10px; /* Espacio entre el botón y el título */
        }
    </style>
@endsection
