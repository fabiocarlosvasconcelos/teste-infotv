<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui são registradas as rotas da API do aplicativo. Estes
| rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| é designado ao grupo de middleware "api". 
| Utilize o comando php artisan route:list para ver todas as todas do aplicativo
|
*/

Route::group(['middleware' => ['verify.jwt'],'prefix' => 'v1'], function () {

    Route::resource('movies', 'MoviesController', []);

});

Route::group(['prefix' => 'v1'], function () {

    //apenas store pode ser um método publico (cadastro do usuário)
    Route::resource('users', 'UserController')->only([
        'store'
    ]);
    
});
