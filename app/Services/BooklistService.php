<?php

namespace App\Services;

interface BooklistService
{
    public function saveBook(string $id, string $book): void;

    public function getBooklist(): array;
}