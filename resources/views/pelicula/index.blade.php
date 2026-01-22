@extends('layouts.app')

@section('template_title')
    Pelicula
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Pelicula') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('peliculas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    {{ __('Agregar') }}
                                </a>

                                <a href="{{ route('home') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    Regresar
                                </a>
                            </div>


                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Título</th>
                                        <th>Género</th>
                                        <th>Año</th>
                                        <th>Imagen</th> <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peliculas as $pelicula)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $pelicula->titulo }}</td>
                                            <td>{{ $pelicula->genero }}</td>
                                            <td>{{ $pelicula->año }}</td>

                                            <td>
                                                @if ($pelicula->foto)
                                                    <img src="{{ Storage::url($pelicula->foto) }}" alt="Foto de la película" width="100"> @else
                                                    <span>No disponible</span>
                                                @endif
                                            </td>


                                            <td>
                                                <form action="{{ route('peliculas.destroy',$pelicula->id) }}" method="POST">
                                                    <div class="d-flex flex-column gap-1"> {{-- Cambiamos a flex-column --}}
                                                        <a class="btn btn-sm btn-primary fixed-width-btn" href="{{ route('peliculas.show',$pelicula->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                        <a class="btn btn-sm btn-success fixed-width-btn" href="{{ route('peliculas.edit',$pelicula->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm fixed-width-btn"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $peliculas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

<style>
    .fixed-width-btn {
        width: 80px; /* Ajusta este valor al ancho deseado */
        text-align: center;
        display: block; /* Para que ocupen todo el ancho del contenedor y se apilen */
        margin-bottom: 0.25rem; /* Añade un pequeño espacio entre los botones */
    }

    .fixed-width-btn:last-child {
        margin-bottom: 0; /* Elimina el margen inferior del último botón */
    }

    .d-flex.flex-column {
        display: flex !important;
        flex-direction: column !important;
    }

    .d-flex.gap-1 {
        gap: 0.25rem !important; /* Ajusta el espacio entre los botones */
    }

    /* Estilos existentes */
</style>