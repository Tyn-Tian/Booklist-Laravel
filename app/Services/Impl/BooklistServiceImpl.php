<?php

namespace App\Services\Impl;

use App\Services\BooklistService;
use Illuminate\Support\Facades\Session;

class BooklistServiceImpl implements BooklistService
{
    public function saveBook(string $id, string $book): void
    {
        if (!Session::exists("booklist")) {
            Session::put("booklist", []);
        }

        Session::push("booklist", [
            "id" => $id,
            "book" => $book
        ]);
    }

    public function getBooklist(): array
    {
        return Session::get("booklist", []);
    }

    public function removeBook(string $bookId): void
    {
        $booklist = Session::get("booklist", []);

        foreach ($booklist as $index => $book) {
            if ($book["id"] == $bookId) {
                unset($booklist[$index]);
                break;
            }
        }

        Session::put("booklist", $booklist);
    }
}