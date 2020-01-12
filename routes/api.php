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
