<?php

namespace App\Http\Controllers;

use App\Models\Reseña;
use App\Models\Pelicula;
use App\Http\Requests\ReseñaRequest;

class ReseñaController extends Controller
{
    public function index()
    {
        $reseñas = Reseña::with('pelicula')->paginate();

        return view('reseña.index', compact('reseñas'))
            ->with('i', (request()->input('page', 1) - 1) * $reseñas->perPage());
    }

    public function create()
    {
        $reseña = new Reseña();
        return view('reseña.create', compact('reseña'));
    }

    /**
     * NUEVO: Formulario para crear reseña desde una película
     */
    public function createDesdePelicula($id)
    {
        // Buscar la película por ID
        $pelicula = Pelicula::findOrFail($id);

        // Retornar la vista de creación de reseña, pasando la película
        return view('reseña.create', compact('pelicula'));
    }

    public function store(ReseñaRequest $request)
    {
        if (!$request->has('pelicula_id')) {
            return redirect()->back()->with('error', 'No se ha especificado la película.');
        }
        
        dd('El método store SÍ se está ejecutando'); // <- lo ponemos antes de todo

        $request->validate([
            'pelicula_id' => 'required|exists:peliculas,id',
            'contenido' => 'required|string|max:1000',
            'calificacion' => 'required|integer|min:1|max:10',
        ]);
    
        Reseña::create([
            'pelicula_id' => $request->pelicula_id,
            'user_id' => auth()->id() ?? 1, // Guarda el ID del usuario logueado
            'contenido' => $request->contenido,
            'calificacion' => $request->calificacion,
        ]);
    
        return redirect()->route('peliculas.show', $request->pelicula_id)
                         ->with('success', 'Reseña agregada correctamente.');
    }

    public function show($id)
    {
        $reseña = Reseña::find($id); // Intenta encontrar la reseña por su ID
    
        if (!$reseña) {
            // Manejar el caso en que la reseña no existe
            abort(404, 'Reseña no encontrada'); // O redirigir con un mensaje de error
        }
    
        return view('reseña.show', compact('reseña')); // Pasa la variable 'reseña' a la vista
    }

    public function edit($id)
    {
        $reseña = Reseña::find($id);

        return view('reseña.edit', compact('reseña'));
    }

    public function update(ReseñaRequest $request, Reseña $reseña)
    {
        $reseña->update($request->validated());

        return redirect()->route('reseñas.index')
            ->with('success', 'Reseña actualizada correctamente.');
    }

    public function destroy($id)
    {
        Reseña::find($id)->delete();

        return redirect()->route('reseñas.index')
            ->with('success', 'Reseña eliminada correctamente.');
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('auth');
    }


}
