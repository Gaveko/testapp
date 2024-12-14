<?php

namespace Gaveko\App\Models;

use Gaveko\Framework\Database\Model;

class Category extends Model
{
    static string $tableName = 'categories';
    private int $id;
    private string $title;

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
}