<?php

namespace App\Custom;

use Illuminate\Support\Stringable;

class StringableCustom
{
    public static function register()
    {
        Stringable::macro('trans', function () {
            return new static(trans($this->value));
        });

    }


}
