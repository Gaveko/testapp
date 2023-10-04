<?php

namespace App\Controllers;

use App\Core\Http\BaseController;
use App\Core\Http\Response;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;

class BooksController extends BaseController
{
    public function index()
    {
        $page = $this->request->getParams()['page'] ?? 1;
        $books = Book::filter($this->request);
        $message = $_SESSION['successMessage']; 
        unset($_SESSION['successMessage']);

        $categories = Category::getAll();
        
        return new Response('index', ['message' => $message, 'books' => $books, 'categories' => $categories, 'page' => $page]);
    }

    public function detail(int $id)
    {
        $book = Book::get($id);

        return new Response('details', ['book' => $book]);
    }

    public function create()
    {
        $categories = Category::getAll();
        $authors = Author::getAll();
        $errors = $_SESSION['errors'] ?? [];
        unset($_SESSION['errors']);

        return new Response('create', ['categories' => $categories, 'authors' => $authors, 'errors' => $errors]);
    }

    public function store()
    {
        $body = $this->request->getBody();
        $isValid = true;
        $errors = [];
        echo '<pre>';
        var_dump($body);
        echo '</pre>';
        if (empty($body['title'])) {
            $isValid = false;
            $errors[] = 'Title is required';
        }
        if (empty($body['price'])) {
            $isValid = false;
            $errors[] = 'Price is required';
        }
        if (!is_numeric($body['price'])) {
            $isValid = false;
            $errors[] = 'Price must be numeric';
        }

        if ($isValid)
        {
            $author = Author::get($body['author_id']);
            $category = Category::get($body['category_id']);

            $book = new Book();
            $book->setTitle($body['title']);
            $book->setDescription($body['description'] ?? '');
            $book->setPrice($body['price']);
            $book->setImage($this->getRandomImage());
            $book->setAuthor($author);
            $book->setCategory($category);
            $book->save();

            $_SESSION['successMessage'] = 'Book created.';
            header('Location: http://localhost:8000');
            exit();
        }
        $_SESSION['errors'] = $errors;
        header('Location: http://localhost:8000/create');
        exit();
    }

    private function getRandomImage()
    {
        $number = rand(1, 4);
        return "image$number.jpg";
    }
}