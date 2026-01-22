<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Reseña
 *
 * @property $id
 * @property $contenido
 * @property $calificación
 * @property $pelicula_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Pelicula $pelicula
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reseña extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pelicula_id',
        'user_id',
        'contenido',
        'calificacion',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }
    
}
