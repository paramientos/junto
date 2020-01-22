<?php


use Endocore\App\Configs\AppConfig;

if ( ! function_exists('make_url')) {
    function make_url()
    {
        return AppConfig::BASE_URL . '/?url=' . implode('/', func_get_args());
    }
}

if ( ! function_exists('redirect')) {
    function redirect($statusCode = 303)
    {
        header('Location: ' . link(func_get_args()), true, $statusCode);
        exit;
    }
}

if ( ! function_exists('get_app_url')) {
    function get_app_url($url)
    {
        return AppConfig::BASE_URL . '/app' . $url;
    }
}

