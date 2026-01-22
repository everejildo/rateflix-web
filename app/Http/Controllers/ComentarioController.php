<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function createDesdePelicula($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('comentario.create', compact('pelicula'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string',
            'calificacion' => 'nullable|integer|min:0|max:10',
            'pelicula_id' => 'required|exists:peliculas,id',
        ]);
    
        $calificacion = $request->filled('calificacion') ? (int) $request->input('calificacion') : 0;
    
        Comentario::create([

            // dd($request->all()),

            'contenido' => $request->input('contenido'),
            'calificacion' => $calificacion, // ✅ aquí sí se usa bien
            'pelicula_id' => $request->input('pelicula_id'),
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('peliculas.show', $request->input('pelicula_id'))
                         ->with('success', 'Comentario guardado correctamente');
    }

}
