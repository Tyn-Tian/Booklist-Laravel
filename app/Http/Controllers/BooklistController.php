<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BooklistService;
use Illuminate\Http\RedirectResponse;
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

    public function addBook(Request $request): RedirectResponse|Response
    {
        $book = $request->input('book');

        if (empty($book)) {
            $booklist = $this->booklistService->getBooklist();
            return response()->view('booklist.booklist', [
                "title" => "Booklist",
                "booklist" => $booklist,
                "error" => "Book is required"
            ]);
        }

        $this->booklistService->saveBook(uniqid(), $book);
        return redirect()->action([BooklistController::class, 'booklist']);
    }

    public function removeBook(Request $request, string $bookId): RedirectResponse
    {
        $this->booklistService->removeBook($bookId);
        return redirect()->action([BooklistController::class, 'booklist']);
    }
}
