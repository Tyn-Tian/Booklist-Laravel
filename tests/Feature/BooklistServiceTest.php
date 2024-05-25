<?php

namespace Tests\Feature;

use App\Services\BooklistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
