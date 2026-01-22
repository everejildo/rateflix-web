<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        // Suponiendo que tengas relaciones definidas para comentarios y favoritos
        $comentarios = $user->comentarios()->count();
        $favoritos = $user->favoritos()->count();

        return view('perfil.index', compact('user', 'comentarios', 'favoritos'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}
