<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Insere os seeds na tabela users.
     *
     * @return void
     */
    public function run()
    {
        
        factory(User::class, 10)->create()->each(function ($user) {
            $user->save();
        });

    }
}
