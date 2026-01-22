@extends('layouts.app')

@section('template_title')
    Perfil de {{ $user->name }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Detalles del Perfil') }}</span>
                        </div>
                        <div class="float-right d-flex"> {{-- Añadimos d-flex para los botones de arriba --}}
                            <button id="mostrarEditarPerfil" class="btn btn-accion btn-sm mr-2">Editar Perfil</button>
                            <a href="{{ url('/home') }}" class="btn btn-accion btn-sm">Regresar</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="mb-2 mb20">
                            <strong>Usuario:</strong>
                            <span id="nombreUsuario">{{ $user->name }}</span>
                        </div>
                        <div class="mb-2 mb20">
                            <strong>Correo:</strong>
                            <span id="correoUsuario">{{ $user->email }}</span>
                        </div>
                        <div class="mb-2 mb20">
                            <strong>Comentarios:</strong>
                            {{ $comentarios }}
                        </div>
                        <div class="mb-2 mb20">
                            <strong>Favoritos:</strong>
                            {{ $favoritos }}
                        </div>
                    </div>
                </div>

                <div id="editarPerfilCard" class="card mt-4" style="display: none;">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar Perfil') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        @if (session('success'))
                            <div class="alert alert-success m-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="formEditarPerfil" method="POST" action="{{ route('perfil.update') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Usuario</label>
                                <input type="text" name="name" class="form-control" id="editarNombre" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control" id="editarCorreo" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary same-size same-color mr-2">Actualizar</button>
                                    <button type="button" id="cancelarEditarPerfil" class="btn btn-secondary same-size same-color">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mostrarEditarPerfilBtn = document.getElementById('mostrarEditarPerfil');
            const editarPerfilCard = document.getElementById('editarPerfilCard');
            const cancelarEditarPerfilBtn = document.getElementById('cancelarEditarPerfil');
            const nombreUsuarioSpan = document.getElementById('nombreUsuario');
            const correoUsuarioSpan = document.getElementById('correoUsuario');
            const editarNombreInput = document.getElementById('editarNombre');
            const editarCorreoInput = document.getElementById('editarCorreo');

            const nombreOriginal = nombreUsuarioSpan.textContent;
            const correoOriginal = correoUsuarioSpan.textContent;

            mostrarEditarPerfilBtn.addEventListener('click', function() {
                editarPerfilCard.style.display = 'block';
                editarNombreInput.value = nombreUsuarioSpan.textContent;
                editarCorreoInput.value = correoUsuarioSpan.textContent;
            });

            cancelarEditarPerfilBtn.addEventListener('click', function() {
                editarPerfilCard.style.display = 'none';
                editarNombreInput.value = nombreOriginal;
                editarCorreoInput.value = correoOriginal;
            });
        });
    </script>

    <style>
        .btn-accion {
            background-color: #007bff; /* Color azul predeterminado de Bootstrap */
            color: white;
            border: none;
            padding: 8px 16px; /* Ajusta el padding para el tamaño */
            font-size: 1rem; /* Ajusta el tamaño de la fuente si es necesario */
        }

        .btn-accion:hover {
            background-color: #0056b3;
        }

        .same-size {
            padding: 8px 16px; /* Mismo padding que btn-accion */
            font-size: 1rem; /* Mismo tamaño de fuente que btn-accion */
        }

        .same-color {
            background-color: #007bff; /* Mismo color de fondo que btn-accion */
            color: white; /* Mismo color de texto que btn-accion */
            border: none; /* Asegurar que no haya borde diferente */
        }

        .same-color:hover {
            background-color: #0056b3; /* Mismo color de hover que btn-accion */
        }

        .d-flex.justify-content-end > .btn {
            margin-left: 0.5rem; /* Separación entre los botones de abajo */
            margin-right: 0;
        }

        .float-right.d-flex > .btn { /* Estilos para los botones de arriba */
            margin-left: 0.5rem;
        }

        .float-right.d-flex > .btn:first-child { /* Eliminar margen izquierdo del primer botón de arriba */
            margin-left: 0;
        }
    </style>
@endsection