<?php

namespace App\Core\Http;

abstract class BaseController
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}