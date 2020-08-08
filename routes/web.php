<?php

use Illuminate\Support\Facades\Route;

// Public URL - Login
// Authentication Routes...
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('/login', fn() => redirect('/'));
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/email', 'Auth\ResetPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// PAINEL
Route::prefix('painel')->middleware('auth')->group(function () {

    Route::get('inicio', 'HomeController@index')->name('home');

    Route::get('usuarios/listar', 'UsersController@list');
    Route::get('usuarios/cadastrar', 'UsersController@showStoreForm');
    Route::post('usuarios/cadastrar', 'UsersController@store');
    Route::get('usuarios/{id}', 'UsersController@show');
    Route::get('usuarios/{id}/editar', 'UsersController@showUpdateForm');
    Route::post('usuarios/{id}/editar', 'UsersController@update');

    # HELPERS AND STATUS
    Route::get("sys/check/redis", "api\sys\ConnectionChecker@redisTest");
    Route::get("sys/check/php", "api\sys\ConnectionChecker@phpinfo");
    Route::get("tasks", "TasksController@index");

});






