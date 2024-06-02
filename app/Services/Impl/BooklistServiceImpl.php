<?php

namespace App\Services\Impl;

use App\Models\Book;
use App\Services\BooklistService;
use Illuminate\Support\Facades\Session;

class BooklistServiceImpl implements BooklistService
{
    public function saveBook(string $id, string $book): void
    {
        $books = new Book([
            "id" => $id,
            "book" => $book
        ]);
        $books->save();
    }

    public function getBooklist(): array
    {
        return Book::query()->get()->toArray();
    }

    public function removeBook(string $bookId): void
    {
        $books = Book::query()->find($bookId);
        if ($books != null) {
            $books->delete();
        }
    }
}