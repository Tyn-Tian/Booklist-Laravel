<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM users");
    }

    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "Christian"
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->seed([UserSeeder::class]);
        $this->post('/login', [
            "email" => "test@gmail.com",
            "password" => "rahasia"
        ])->assertRedirect('/')
            ->assertSessionHas("user", "test@gmail.com");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "Christian"
        ])->post('/login')
            ->assertRedirect('/');
    }

    public function testLoginInputEmpty()
    {
        $this->post('/login', [])
            ->assertSeeText("Email and password is required");
    }

    public function testLoginWrongUser()
    {
        $this->post('/login', [
            "email" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("Email and password is wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "Christian"
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }
}
