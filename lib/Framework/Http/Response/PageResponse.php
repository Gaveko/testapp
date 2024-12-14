<?php

namespace Gaveko\Framework\Http\Response;

use Gaveko\Framework\Http\ResponseInterface;

class PageResponse implements ResponseInterface
{
    private string $view;
    private array $context;

    public function __construct(string $view, array $context = [])
    {
        $this->view = $view;
        $this->context = $context;
    }

    public function render()
    {
        require VIEWS_PATH . '/' . $this->view . '.php';
    }
}