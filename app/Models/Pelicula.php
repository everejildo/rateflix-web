<?php

namespace App\Models;
use App\Models\Pelicula;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pelicula
 *
 * @property $id
 * @property $titulo
 * @property $genero
 * @property $año
 * @property $foto
 * @property $created_at
 * @property $updated_at
 *
 * @property Reseña[] $reseñas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pelicula extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'genero', 'año', 'foto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reseñas()
    {
        return $this->hasMany(\App\Models\Reseña::class, 'id', 'pelicula_id');
    }
    
    public function favoritosDe()
    {
        return $this->belongsToMany(User::class, 'favoritos', 'pelicula_id', 'user_id')->withTimestamps();
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
    

}
