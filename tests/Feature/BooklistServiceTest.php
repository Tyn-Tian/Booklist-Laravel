<?php

namespace Tests\Feature;

use App\Services\BooklistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Assert;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class BooklistServiceTest extends TestCase
{
    private BooklistService $booklistService;

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete("DELETE FROM books");
        $this->booklistService = $this->app->make(BooklistService::class);
    }

    public function testBooklistServiceNotNull()
    {
        self::assertNotNull($this->booklistService);
    } 

    public function testSaveBook()
    {
        $this->booklistService->saveBook("1", "Belajar Laravel Dasar");
        $booklist = $this->booklistService->getBooklist();
        foreach ($booklist as $book) {
            self::assertEquals("1", $book["id"]);
            self::assertEquals("Belajar Laravel Dasar", $book["book"]);
        }
    }

    public function testGetBooklist()
    {
        $expected = [
            [
                "id" => "1",
                "book" => "Belajar PHP Dasar"
            ],
            [
                "id" => "2",
                "book" => "Belajar Laravel Dasar"
            ],
        ];

        $this->booklistService->saveBook("1", "Belajar PHP Dasar");
        $this->booklistService->saveBook("2", "Belajar Laravel Dasar");
        Assert::assertArraySubset($expected, $this->booklistService->getBooklist());
    }

    public function testGetBooklistEmpty()
    {
        $booklist = $this->booklistService->getBooklist();

        self::assertIsArray($booklist);
        self::assertEquals([], $booklist);
    }

    public function testRemoveBook()
    {
        $this->booklistService->saveBook("1", "Belajar Laravel Dasar");
        $this->booklistService->removeBook("1");
        self::assertEquals([], $this->booklistService->getBooklist());
    }
}
