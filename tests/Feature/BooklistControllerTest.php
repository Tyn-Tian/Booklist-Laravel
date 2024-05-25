<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooklistControllerTest extends TestCase
{
    public function testBooklist()
    {
        $this->withSession([
            "user" => "Christian",
            "booklist" => [
                [
                    "id" => "1",
                    "book" => "Belajar PHP Dasar"
                ],
                [
                    "id" => "2",
                    "book" => "Belajar Laravel Dasar"
                ],
            ]
        ])->get('/booklist')
            ->assertSeeText("1")
            ->assertSeeText("Belajar PHP Dasar")
            ->assertSeeText("2")
            ->assertSeeText("Belajar Laravel Dasar");
    }

    public function testAddBookSuccess()
    {
        $this->withSession([
            "user" => "Christian"
        ])->post('/booklist', [
            "book" => "Belajar Laravel Dasar"
        ])->assertRedirect('/booklist');
    }

    public function testAddBookEmpty()
    {
        $this->withSession([
            "user" => "Christian"
        ])->post('/booklist')
            ->assertSeeText("Book is required");
    }

    public function testRemoveBook() {
        $this->withSession([
            "user" => "Christian",
            "booklist" => [
                [
                    "id" => "1",
                    "book" => "Belajar Laravel Dasar"
                ]
            ]
        ])->post('/booklist/1/delete')
            ->assertRedirect('/booklist');
    }
}
