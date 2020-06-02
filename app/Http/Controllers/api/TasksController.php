<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    public function index()
    {
        Redis::set('REDIS', 'REDIS');
        // return Redis::get('REDIS');

        Cache::put('CACHEA', 'CACHEA');
        //  return Cache::get('CACHEA');

        Session::put('a', ['SESSIONNN', 'SESSIONNN', 'SESSIONNN']);
        return [Session::get('SESSIONNN')];


    }
}
