<?php

use App\Models\Movie;
use App\Models\Tag;
use Faker\Generator as Faker;

/** 
* Cria instâncias dos modelos das tabelas do banco de dados para ser utilizada
* em testes e sementes (seeds)
*/
$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'movie_id' => Movie::all()->random()->id,
    ];
});
