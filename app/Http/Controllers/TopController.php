<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;

class TopController extends Controller
{
    //
    public function index()
    {
        $topPeliculas = Pelicula::with('comentarios')
            ->get()
            ->sortByDesc(function ($pelicula) {
                return $pelicula->comentarios->avg('calificacion');
            })
            ->take(10)
            ->values(); // 👈 ESTA línea es clave
    
        return view('top.index', ['peliculas' => $topPeliculas]);
    }
    
}
