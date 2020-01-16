<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    /**
     * Os atributos que devem estar ocultos nos arrays retornados
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
    
    /**
     * Atributos que são enviados para o banco, as colunas não definidas aqui,
     * são ignoradas
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
