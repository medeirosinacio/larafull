<?php

namespace App\Custom;

use App\Support\Notifier;
use Illuminate\Support\Facades\Response;

class ResponseCustom
{
    /**
     * Register the application's response macros.
     *
     * @return void
     */
    public static function register()
    {
        Response::macro('success', function (array $content = [], int $status = 201, array $headers = []) {

            $message = trans("The data entered were successfully saved.");

            if (!empty($content['redirect'])) {
                Notifier::success($message);
                return Response::make($content, $status, $headers);
            }

            return Response::make(array_merge([
                'message' => $message
            ], $content), $status, $headers);
        });

    }
}
