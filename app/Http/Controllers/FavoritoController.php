<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function toggle($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->favoritos()->where('pelicula_id', $id)->exists()) {
            $user->favoritos()->detach($id); // Elimina de favoritos
        } else {
            $user->favoritos()->attach($id); // Añade a favoritos
        }

        return back();
    }

    public function index()
    {
        $user = Auth::user();
        $favoritas = $user->favoritos; // Películas favoritas

        return view('favorites', compact('favoritas'));
    }

    public function mostrarFavoritos()
    {
        $usuario = Auth::user();
        $favoritas = $usuario->favoritos;
    
        return view('favorites', compact('favoritas'));
    }

}
