<?php

use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Insere os seeds na tabela tags.
     *
     * @return void
     */
    public function run()
    {
        
        Tag::create([
            'name' => Str::random(10),
            'movie_id' => Movie::all()->random()->id,
        ]);

    }
}
