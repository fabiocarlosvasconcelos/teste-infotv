<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * Atributos que são enviados para o banco, as colunas não definidas aqui,
     * são ignoradas
     *
     * @var array
     */
    protected $fillable = [
        'name', 'file' , 'file_size'
    ];
}
