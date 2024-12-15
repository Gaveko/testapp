<?php

namespace Gaveko\Framework\Http\Response;

use Gaveko\Framework\Http\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function render()
    {
        header("Content-Type: application/json");
        echo json_encode($this->data);
    }
}