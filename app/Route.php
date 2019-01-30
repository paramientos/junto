<?php

namespace Endocore\App;

class Route
{

    public static $routes = array();

    public static function get($route, $controller, $action)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::makeRoute($route, $controller, $action);
        }
    }

    public static function post($route, $controller, $action)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::makeRoute($route, $controller, $action);
        }
    }

    public static function put($route, $controller, $action)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            self::makeRoute($route, $controller, $action);
        }
    }

    public static function delete($route, $controller, $action)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            self::makeRoute($route, $controller, $action);
        }
    }

    private function makeRoute($route, $controller, $action)
    {
        array_push(self::$routes, [$route => "{$controller}Controller:{$action}Action"]);
    }


}