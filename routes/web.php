<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ReseñaController;
use App\Models\Pelicula;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Auth::routes();

// Vistas estáticas
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::view('/top', 'top')->name('top');
Route::view('/favorites', 'favorites')->name('favorites');

// CRUD de películas y reseñas
Route::resource('peliculas', PeliculaController::class);
Route::resource('reseñas', ReseñaController::class)->except(['create']);

// Crear reseña desde una película específica
Route::get('/peliculas/{id}/reseñas/create', [ReseñaController::class, 'createDesdePelicula'])->name('reseñas.createDesdePelicula');

// Almacenar reseña
// Route::post('/reseñas', [ReseñaController::class, 'store'])->name('reseñas.store');
Route::resource('reseñas', ReseñaController::class);

// Crear reseña
Route::get('/reseñas/create', [ReseñaController::class, 'create'])->name('reseñas.create');
Route::get('peliculas/{id}/reseñas/create', [ReseñaController::class, 'createDesdePelicula'])->name('reseñas.createDesdePelicula');

//Comentarios
Route::get('/peliculas/{id}/comentarios/create', [ComentarioController::class, 'createDesdePelicula'])->name('comentarios.createDesdePelicula');
// Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::post('/peliculas/{pelicula}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');

// Categorias
// Route::get('/categories/{genero}', [PeliculaController::class, 'porGenero'])->name('peliculas.porGenero');
Route::get('/categories/{genero?}', [PeliculaController::class, 'porGenero'])->name('peliculas.porGenero');
Route::get('/categories', [PeliculaController::class, 'categorias'])->name('categories');

// Top
Route::get('/top', [TopController::class, 'index'])->name('top.index');
Route::get('/top', [App\Http\Controllers\PeliculaController::class, 'top'])->name('peliculas.top');
Route::get('/top', [PeliculaController::class, 'top'])->name('peliculas.top');

// Home
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

// Buscador
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Perfil
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil');
    Route::post('/perfil/update', [ProfileController::class, 'update'])->name('perfil.update');
});

// Favoritos
Route::post('/pelicula/{id}/favorito', [PeliculaController::class, 'toggleFavorito'])->middleware('auth')->name('pelicula.favorito');
Route::get('/favorites', [PeliculaController::class, 'mostrarFavoritos'])
    ->middleware('auth')
    ->name('favorites');
