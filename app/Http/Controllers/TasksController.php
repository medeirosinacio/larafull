<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    public function index()
    {
        Redis::set('REDIS__A', 'REDIS__A');
        Cache::put('CACHEA', 'CACHEA');
        Session::put('a', ['SESSIONNN', 'SESSIONNN', 'SESSIONNN']);

        return [Redis::get('REDIS__A'), Cache::get('CACHEA'), Session::get('a')];
    }
}
