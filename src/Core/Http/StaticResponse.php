<?php

namespace App\Core\Http;

class StaticResponse
{
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = substr($filename, 0, strlen($filename) - 1);
    }

    public function render()
    {
        if (str_contains($this->filename, '.css')) {
            header("Content-Type: text/css");
        } elseif (str_contains($this->filename, '.js')) {
            header("Content-Type: text/javascript");
        } elseif (str_contains($this->filename, '.jpg')) {
            header("Content-Type: image/jpg");
        }
        echo file_get_contents($this->filename);
    }
}