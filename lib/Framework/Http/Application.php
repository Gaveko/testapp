<?php

namespace Gaveko\Framework\Http;

class Application
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router;
    }

    public function handle(Request $request)
    {
        return $this->router->execute($request);
    }
}