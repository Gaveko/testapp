<?php

use Gaveko\App\Controllers\BooksController;
use Gaveko\Framework\Http\Route;

return [
    Route::get('/details/@id/', BooksController::class, 'detail'),
    Route::get('/create/', BooksController::class, 'create'),
    Route::post('/store/', BooksController::class, 'store'),
    Route::get('/', BooksController::class, 'index')
];