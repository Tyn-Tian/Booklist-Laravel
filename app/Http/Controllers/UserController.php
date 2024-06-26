<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {
    }

    public function login(): Response
    {
        return response()
            ->view('user.login', [
                "title" => "Login"
            ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $email = $request->input("email");
        $password = $request->input("password");

        if (empty($email) || empty($password)) {
            return response()->view('user.login', [
                "title" => "Login",
                "error" => "Email and password is required"
            ]);
        }

        if ($this->userService->login($email, $password)) {
            $request->session()->put("user", $email);
            return redirect('/');
        }

        return response()->view('user.login', [
            "title" => "Login",
            "error" => "Email and password is wrong"
        ]);
    }

    public function doLogout(Request $request): RedirectResponse
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}
