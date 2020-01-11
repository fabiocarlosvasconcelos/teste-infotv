<?php

use App\Models\User;
use Faker\Generator as Faker;

/** 
* Cria instâncias dos modelos das tabelas do banco de dados para ser utilizada
* em testes e sementes (seeds)
*/
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});
