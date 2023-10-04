<?php

namespace App\Models;

use App\Core\Database\DBConnection;
use App\Core\Database\Model;

class Book extends Model
{
    static string $tableName = 'books';
    private int $id;
    private string $title;
    private ?string $description;
    private ?string $image;
    private float $price;
    private Author $author;
    private Category $category;

    public function save()
    {
        $pdo = DBConnection::getInstance()->getPDO();
        $authorId = $this->author->getId();
        $categoryId = $this->category->getId();
        $sql = "INSERT INTO books (title, description, image, price, author_id, category_id) 
        VALUES ('$this->title', '$this->description', '$this->image', $this->price, $authorId, $categoryId)";

        $pdo->exec($sql);
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function setImage($value)
    {
        $this->image = $value;
    }

    public function setAuthor($value)
    {
        $this->author = $value;
    }

    public function setCategory($value)
    {
        $this->category = $value;
    }

    public function setPrice($value)
    {
        $this->price = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}