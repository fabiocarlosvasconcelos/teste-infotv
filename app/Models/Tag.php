<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Atributos que são enviados para o banco
     *
     * @var array
     */
    protected $fillable = [
        'name', 'movie_id'
    ];
}
