<?php

namespace Gaveko\App\Models;

use Gaveko\Framework\Database\Model;

class Author extends Model
{
    static string $tableName = 'authors';
    private int $id;
    private string $fullname;

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setFullname($value)
    {
        $this->fullname = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFullname()
    {
        return $this->fullname;
    }
}