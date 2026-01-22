<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenido',
        'calificacion', // <- ¡asegúrate de que esto esté aquí!
        'pelicula_id',
        'user_id',
    ];

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }    
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
