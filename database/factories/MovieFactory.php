<?php

use App\Models\Movie;
use Faker\Generator as Faker;

/** 
* Cria instâncias dos modelos das tabelas do banco de dados para ser utilizada
* em testes e sementes (seeds)
*/
$factory->define(Movie::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'file' => $faker->word.'.mkv',
        'file_size' =>  rand(1, 5000)
    ];
});
