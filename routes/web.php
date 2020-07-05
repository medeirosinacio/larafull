<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# HELPERS AND STATUS
Route::get("sys/check/redis", "api\sys\ConnectionChecker@redisTest");
Route::get("sys/check/php", "api\sys\ConnectionChecker@phpinfo");

Route::get("tasks", "TasksController@index");

