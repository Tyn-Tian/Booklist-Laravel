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
}
