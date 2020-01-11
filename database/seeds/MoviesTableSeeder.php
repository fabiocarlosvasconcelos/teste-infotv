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
        
        Movie::create([
            'name' => Str::random(10),
            'file' => Str::random(20).'.mkv',
            'file_size' =>  rand(1, 5000)
        ]);
        
    }
}
