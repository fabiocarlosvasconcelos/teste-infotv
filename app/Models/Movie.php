<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * Atributos que são enviados para o banco
     *
     * @var array
     */
    protected $fillable = [
        'name', 'file' , 'file_size'
    ];
}
