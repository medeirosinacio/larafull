<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function cleanCache()
    {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');

        return response()->success([
            'message' => trans('Cache is cleared.')
        ]);

    }

    public function phpinfo()
    {
        phpinfo();
    }
}
