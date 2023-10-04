<?php

namespace App\Core\Http;

class Route
{
    private function __construct(
        private string $method,
        private string $path,
        private $controller,
        private string $action
    ) {
    }

    static function get(string $path, $controller, string $action)
    {
        $method = 'GET';
        return new Route($method, $path, $controller, $action);
    }

    static function post(string $path, $controller, string $action)
    {
        $method = 'POST';
        return new Route($method, $path, $controller, $action);
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }
}