<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "Christian",
            "password" => "rahasia"
        ])->assertRedirect('/')
            ->assertSessionHas("user", "Christian");
    }

    public function testLoginInputEmpty()
    {
        $this->post('/login', [])
            ->assertSeeText("User and password is required");
    }

    public function testLoginWrongUser()
    {
        $this->post('/login', [
            "user" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("User and password is wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "Christian"
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }
}
