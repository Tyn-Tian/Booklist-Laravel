<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BooklistService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BooklistController extends Controller
{
    public function __construct(
        private BooklistService $booklistService
    ) {
    }

    public function booklist(Request $request): Response
    {
        $booklist = $this->booklistService->getBooklist();
        return response()->view('booklist.booklist', [
            "title" => "Booklist",
            "booklist" => $booklist
        ]);
    }

    public function addBook(Request $request)
    {
    }

    public function removeBook(Request $request, string $bookId)
    {
    }
}
