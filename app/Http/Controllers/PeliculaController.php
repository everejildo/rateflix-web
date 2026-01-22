<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Http\Requests\PeliculaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * Class PeliculaController
 * @package App\Http\Controllers
 */
class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peliculas = Pelicula::paginate();

        return view('pelicula.index', compact('peliculas'))
            ->with('i', (request()->input('page', 1) - 1) * $peliculas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelicula = new Pelicula();
        return view('pelicula.create', compact('pelicula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeliculaRequest $request)
    {
        $request->validate([
            'titulo' => 'required',
            'genero' => 'required',
            'año' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Validación de la foto
        ]);

        $pelicula = new Pelicula();
        $pelicula->titulo = $request->titulo;
        $pelicula->genero = $request->genero;
        $pelicula->año = $request->año;

        if ($request->hasFile('foto')) {
            // Guardar la foto
            $path = $request->file('foto')->store('fotos', 'public');
            $pelicula->foto = $path; // Guardamos la ruta de la foto
        }

        $pelicula->save();

        return redirect()->route('peliculas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pelicula = Pelicula::find($id);

        return view('pelicula.show', compact('pelicula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelicula = Pelicula::find($id);

        return view('pelicula.edit', compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PeliculaRequest $request, Pelicula $pelicula)
    {
        $pelicula->update($request->validated());

        return redirect()->route('peliculas.index')
            ->with('success', 'Pelicula updated successfully');
    }

    public function mostrarFavoritos()
    {
        $usuario = Auth::user();
        $favoritas = $usuario->favoritos; // asumiendo que tienes la relación definida en el modelo User
    
        return view('favorites', compact('favoritas'));
    }

    public function destroy($id)
    {
        Pelicula::find($id)->delete();

        return redirect()->route('peliculas.index')
            ->with('success', 'Pelicula deleted successfully');
    }
    
    public function toggleFavorito($id)
    {
        $usuario = Auth::user();
        $pelicula = Pelicula::findOrFail($id);
    
        if ($usuario->favoritos->contains($pelicula)) {
            $usuario->favoritos()->detach($pelicula);
        } else {
            $usuario->favoritos()->attach($pelicula);
        }
    
        return redirect()->back()->with('success', 'Película actualizada en favoritos.');
    }

    public function porGenero($genero)
    {
        // Trae todas las películas
        $peliculas = \App\Models\Pelicula::all()->filter(function ($pelicula) use ($genero) {
            // Divide los géneros separados por coma en array
            $generos = array_map('trim', explode(',', $pelicula->genero));
            // Verifica si el género buscado está en el array
            return in_array($genero, $generos);
        });
    
        return view('categories', compact('genero', 'peliculas'));
    } 

    public function categorias()
    {
        return view('categories', ['peliculas' => collect(), 'genero' => null]);
    }

    public function top()
    {
        $peliculas = Pelicula::with('comentarios')
            ->get()
            ->map(function ($pelicula) {
                $pelicula->promedio = $pelicula->comentarios->avg('calificacion') ?? 0;
                return $pelicula;
            })
            ->sortByDesc('promedio')
            ->take(10);
    
        return view('top', compact('peliculas'));
    }
    

}
