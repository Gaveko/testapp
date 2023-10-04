<?php

namespace App\Core\Http;

class Request
{
    private string $method;
    private string $path;
    private array $params;
    private array $body;

    private function __construct(
        string $method,
        string $path,
        array $params = [],
        array $body = []
    ) {
        $this->method = $method;
        $this->path = $path;
        $this->params = $params;
        $this->body = $body;
    }

    static function getRequestFromGlobal(): Request
    {
        return new Request(
            $_SERVER['REQUEST_METHOD'],
            static::preparePath($_SERVER['REQUEST_URI']),
            $_GET,
            $_POST
        );
    }

    static function preparePath(string $rawPath)
    {
        $path = $rawPath;

        if ($path == '/') {
            return $path;
        }

        if (str_contains($path, '?')) {
            $pos = strpos($path, '?');
            $path = substr_replace($path, '', $pos);
        }

        if (substr($path, -1) != '/') {
            $path.='/';
        } 

        return $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getBody()
    {
        return $this->body;
    }
}