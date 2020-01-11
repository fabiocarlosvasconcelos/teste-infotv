<?php

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Insere os seeds na tabela movies.
     *
     * @return void
     */
    public function run()
    {
        
        factory(Movie::class, 10)->create()->each(function ($movie) {
            $movie->save();
        });
        
    }
}
