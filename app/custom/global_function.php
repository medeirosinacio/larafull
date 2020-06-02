<?php

#########################################################
######################### DEBUG #########################
#########################################################

/**
 * Printa variavel com print_r formatado
 * @param mixed $value
 * @return mixed
 */
function print_p($value, $return = false)
{
    if ($return) {
        return '<pre>' . print_r($value, true) . '</pre>';
    } else {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }

}

/**
 * Printa variavel com print_r formatado e mata o codigo
 * @param mixed $value
 * @return mixed
 */
function print_pd($value, $return = false)
{
    if ($return) {
        return '<pre>' . print_r($value, true) . '</pre>';
    } else {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
    die;
}

/**
 * Printa variavel com print_r formatado no arquivo dentro do log
 * @param mixed $value
 * @return mixed
 */
function print_f($value)
{
    $t = explode(" ", microtime());

    $output = print_r($value, true);
    file_put_contents('/app/runtime/logs/print_r-' .
        date("Y-m-d H-i-s ", $t[1]) . substr((string)$t[0], 1, 4) . '.txt', $output);
}

/**
 * Printa variavel em Json formatado
 * @param mixed $value
 * @return mixed
 */
function print_j($value)
{
    echo '<pre>' . Json_encode($value, JSON_PRETTY_PRINT) . '</pre>';
}

/**
 * Printa variavel em var_dump sem limites de caracteres
 * @param mixed $value
 * @return mixed
 */
function print_d($value)
{
    ini_set('xdebug.var_display_max_depth', '25');
    ini_set('xdebug.var_display_max_children', '256');
    ini_set('xdebug.var_display_max_data', '2048');
    var_dump($value);
}

/**
 * Printa variavel em var_dump sem limites de caracteres e mata o codigo
 * @param mixed $value
 * @return mixed
 */
function print_dd($value)
{
    ini_set('xdebug.var_display_max_depth', '25');
    ini_set('xdebug.var_display_max_children', '256');
    ini_set('xdebug.var_display_max_data', '2048');
    var_dump($value);
    die;
}

function diet($a = null)
{
    die($a ?? 'true');
}

#########################################################
################### GLOBAL FUNCTIONS ####################
#########################################################

/**
 * List true files and true directories inside the specified path
 * @param $directory
 * @return array
 */
function true_scandir($directory)
{
    $result = [];
    $cdir = scandir($directory);
    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (is_dir($directory . DIRECTORY_SEPARATOR . $value)) {
                $result[$value] = true_scandir($directory . DIRECTORY_SEPARATOR . $value);
            } else {
                $result[] = str_replace('.php', '', $value);
            }
        }
    }

    return $result;
}

/**
 * Checks if the class has been defined and Checks if the class method exists
 * @param $class_object
 * @param $method_name
 * @return bool
 */
function class_method_exists($class_object, $method_name)
{
    if (class_exists($class_object) && method_exists($class_object, $method_name)) {
        return true;
    }

    return false;
}

/**
 * FIX_BUG: filter_input() doesn't work with INPUT_SERVER or INPUT_ENV when you use FASTCGI
 * @param $type
 * @param $variable_name
 * @param int $filter
 * @param null $options
 * @return mixed|null
 * @package https://stackoverflow.com/questions/25232975/php-filter-inputinput-server-request-method-returns-null/25385553
 */
function filter_input_fix($type, $variable_name, $filter = FILTER_DEFAULT, $options = null)
{
    $checkTypes = [
        INPUT_GET,
        INPUT_POST,
        INPUT_COOKIE
    ];

    if ($options === null) {
        // No idea if this should be here or not
        // Maybe someone could let me know if this should be removed?
        $options = FILTER_NULL_ON_FAILURE;
    }

    if (in_array($type, $checkTypes) || filter_has_var($type, $variable_name)) {
        return filter_input($type, $variable_name, $filter, $options);
    } else {
        if ($type == INPUT_SERVER && isset($_SERVER[$variable_name])) {
            return filter_var($_SERVER[$variable_name], $filter, $options);
        } else {
            if ($type == INPUT_ENV && isset($_ENV[$variable_name])) {
                return filter_var($_ENV[$variable_name], $filter, $options);
            } else {
                return null;
            }
        }
    }
}

/**
 * It's a modified file_get_contents()
 * get_contents(filename, use_include_path, context, offset, maxlen)
 * @param $url
 * @param bool $u
 * @param null $c
 * @param null $o
 * @return bool|string
 * @package https://stackoverflow.com/questions/8673272/php-if-file-get-contents-fails-do-this-instead
 */
function get_contents($url, $u = false, $c = null, $o = null)
{
    $headers = get_headers($url);
    $status = substr($headers[0], 9, 3);
    if ($status == '200') {
        return file_get_contents($url, $u, $c, $o);
    }
    return false;
}

/**
 * Simple multi-bytes ucfirst()
 * @param $str
 * @return string
 */
function mb_ucfirst_fix($str)
{
    return mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr(mb_strtolower($str), 1);
}


/**
 * Simple multi-bytes ucfirst()
 * @param $str
 * @return string
 */
if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst($str)
    {
        return mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1);
    }
}

/**
 * PHP8
 */

if (PHP_VERSION_ID >= 80000) {

    if (!defined('FILTER_VALIDATE_BOOL') && defined('FILTER_VALIDATE_BOOLEAN')) {
        define('FILTER_VALIDATE_BOOL', FILTER_VALIDATE_BOOLEAN);
    }

    if (!function_exists('fdiv')) {
        function fdiv(float $dividend, float $divisor): float
        {
            return \Symfony\Polyfill\Php80\Php80::fdiv($dividend, $divisor);
        }
    }
    if (!function_exists('preg_last_error_msg')) {
        function preg_last_error_msg(): string
        {
            return \Symfony\Polyfill\Php80\Php80::preg_last_error_msg();
        }
    }
    if (!function_exists('str_contains')) {
        function str_contains(string $haystack, string $needle): bool
        {
            return \Symfony\Polyfill\Php80\Php80::str_contains($haystack, $needle);
        }
    }
    if (!function_exists('str_starts_with')) {
        function str_starts_with(string $haystack, string $needle): bool
        {
            return \Symfony\Polyfill\Php80\Php80::str_starts_with($haystack, $needle);
        }
    }
    if (!function_exists('str_ends_with')) {
        function str_ends_with(string $haystack, string $needle): bool
        {
            return \Symfony\Polyfill\Php80\Php80::str_ends_with($haystack, $needle);
        }
    }
    if (!function_exists('get_debug_type')) {
        function get_debug_type($value): string
        {
            return \Symfony\Polyfill\Php80\Php80::get_debug_type($value);
        }
    }
    if (!function_exists('get_resource_id')) {
        function get_resource_id($res): int
        {
            return \Symfony\Polyfill\Php80\Php80::get_resource_id($res);
        }
    };
}
