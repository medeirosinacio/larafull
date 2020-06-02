<?php

namespace App\Http\Controllers\api\sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ConnectionChecker extends Controller
{
    public static function redisTest()
    {
        $redis = Redis::connection();
        try {
            return $redis->ping();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
