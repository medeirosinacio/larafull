<?php

namespace App\Custom;

use Illuminate\Support\Facades\Request;

class RequestCustom
{

    public static function register()
    {
        Request::macro('isGet', function () {
            return $this->isMethod('get') === true;
        });
    }

}
