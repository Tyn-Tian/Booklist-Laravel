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

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "Christian"
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "Christian",
            "password" => "rahasia"
        ])->assertRedirect('/')
            ->assertSessionHas("user", "Christian");
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

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }
}
