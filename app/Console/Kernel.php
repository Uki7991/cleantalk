<?php

namespace App\Console;

use App\Exceptions\Handler as ExceptionHandler;
use App\Http\Route;

class Kernel
{
    private $handler;

    public function __construct()
    {
        $this->handler = new ExceptionHandler();
    }

    /**
     * @param array $input
     * @return int
     */
    public function handle(array $input): int
    {
        $status = 0;
        try {
            array_shift($input);
            $this->callCommand(array_shift($input), $input);
        } catch (\Throwable $exception) {
            $this->handler->renderException($exception);
            $status = 1;
        }

        return $status;
    }

    private function callCommand($command, $params)
    {
        $routes = Route::$routes;
        $routeData = $routes['console'][$command];

        if (!$routeData) {
            throw new \Exception('console command not found');
        }

        if (isset($routeData['function'])) {
            return $routeData['function']();
        }

        $controller = new $routeData['controller'];

        return $controller->{$routeData['action']}();
    }
}