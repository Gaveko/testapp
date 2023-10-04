<?php

namespace App\Core\Http;

use App\Core\Http\Request;
use App\Core\Http\StaticResponse;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = require(CONF_PATH . '/routes.php');
    }

    public function execute(Request $request)
    {
        if (str_contains($request->getPath(), 'static') || str_contains($request->getPath(), 'storage')) {
            return new StaticResponse($request->getPath());
        }
        foreach ($this->routes as $route) {
            if ($route->getMethod() === $request->getMethod()) {
                $matchInfo = $this->isMatch($route, $request);
                if ($matchInfo['isMatch']) {
                    $controllerClass = $route->getController();
                    $controller = new $controllerClass($request);
                    $action = $route->getAction();
                    return $controller->$action(...$matchInfo['args']);
                }
            }
        }
        return new Response('default/404');
    }

    private function isMatch(Route $route, Request $request): array
    {
        $routePathArray = explode('/', $route->getPath());
        $requestPathArray = explode('/', $request->getPath());
        $matchInfo = [
            'isMatch' => true,
            'args' => []
        ];
        $args = [];
        for ($i = 0; $i < count($routePathArray); $i++) {
            if (str_contains($routePathArray[$i], '@')) {
                if ($requestPathArray[$i] != '') {
                    $args[] = $requestPathArray[$i];
                    continue;
                }
                else {
                    $matchInfo['isMatch'] = false;
                    break;
                }
            }
            if ($routePathArray[$i] != $requestPathArray[$i]) {
                $matchInfo['isMatch'] = false;
                break;
            }
        }
        $matchInfo['args'] = $args;
        return $matchInfo;
    }
}