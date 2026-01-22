<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Se consulta directamente en la base de datos antes de paginar
        $query = Pelicula::query();
    
        if (!empty($search)) {
            $query->where('titulo', 'like', '%' . $search . '%');
        }
    
        $peliculas = $query->paginate(24); // Sigue mostrando 24 por página
    
        return view('home', compact('peliculas'));
    }

    public function home()
    {
        $peliculas = Pelicula::paginate(24);

        return view('home', compact('peliculas'));
    }
    
}
