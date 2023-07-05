<?php

namespace App\Http;

class Route
{
    public static array $routes = [];

    public static function get(string $url, callable|string $controller, string $action = null): void
    {
        self::registerRoute('get', $url, $controller, $action);
    }

    public static function post(string $url, callable|string $controller, string $action = null): void
    {
        self::registerRoute('post', $url, $controller, $action);
    }

    public static function put(string $url, callable|string $controller, string $action = null): void
    {
        self::registerRoute('put', $url, $controller, $action);
    }

    public static function delete(string $url, callable|string $controller, string $action = null): void
    {
        self::registerRoute('delete', $url, $controller, $action);
    }

    public static function console(string $command, callable|string $controller, string $action = null): void
    {
        self::registerRoute('console', $command, $controller, $action);
    }

    private static function registerRoute(string $method, string $url, callable|string $controller, string $action = null): void
    {
        if ($controller instanceof \Closure) {
            self::$routes[$method][$url] = [
                'function' => $controller,
            ];
            return;
        }

        self::$routes[$method][$url] = [
            'controller' => $controller,
            'action' => $action,
        ];
    }
}