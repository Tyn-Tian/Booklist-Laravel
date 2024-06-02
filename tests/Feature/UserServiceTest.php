<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete("DELETE from users");
        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        $this->seed([UserSeeder::class]);
        self::assertTrue($this->userService->login("test@gmail.com", "rahasia"));
    }

    public function testLoginUserNotFount()
    {
        self::assertFalse($this->userService->login("notfound", "rahasia"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("Christian", "wrong"));
    }
}
