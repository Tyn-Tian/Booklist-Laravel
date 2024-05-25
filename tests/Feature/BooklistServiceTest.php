<?php

namespace Tests\Feature;

use App\Services\BooklistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class BooklistServiceTest extends TestCase
{
    private BooklistService $booklistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->booklistService = $this->app->make(BooklistService::class);
    }

    public function testBooklistServiceNotNull()
    {
        self::assertNotNull($this->booklistService);
    } 

    public function testSaveBook()
    {
        $this->booklistService->saveBook("1", "Belajar Laravel Dasar");
        $booklist = Session::get("booklist");

        foreach ($booklist as $book) {
            self::assertEquals("1", $book["id"]);
            self::assertEquals("Belajar Laravel Dasar", $book["book"]);
        }
    }
}
