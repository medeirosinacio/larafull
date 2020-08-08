<?php

namespace App\Support;

use Illuminate\Support\Facades\Session;

class Notifier
{

    public static function notify(string $type, string $message, string $title = '', array $options = [])
    {
        $value = Session::get('notifier', []);
        $values[] = $value;
        Session::push('notifier', [$type, $message, $title, $options]);
    }

    public static function info(string $message, string $title = '', array $options = [])
    {
        self::notify('info', $message, $title, $options);
    }

    public static function success(string $message, string $title = '', array $options = [])
    {
        self::notify('success', $message, $title, $options);
    }

    public static function warning(string $message, string $title = '', array $options = [])
    {
        self::notify('warning', $message, $title, $options);
    }

    public static function error(string $message, string $title = '', array $options = [])
    {
        self::notify('error', $message, $title, $options);
    }

    /**
     * Blade show notifier
     */
    public static function show()
    {
        $notifiers = [];

        $values = Session::get('notifier', []);
        Session::forget('notifier');

        if (is_array($values) && !empty($values)) {
            foreach ($values as $value) {

                $value[0] = $value[0] ??= '';
                $value[1] = $value[1] ??= '';
                $value[2] = $value[2] ??= '';
                $value[3] = $value[3] ? json_encode($value[3]) : '';

                if (!empty($value[0])) {
                    $notifiers[] = "notifier.{$value[0]}('{$value[1]}','{$value[2]}','{$value[3]}');";
                }

            }

            return
                "<script type=\"text/javascript\"> setTimeout(function(){ " .
                implode('', $notifiers) .
                "}, 1000); </script>";
        }

    }

}
