<?php

namespace App\Services\Impl;

use App\Services\UserService;

class userServiceImpl implements UserService
{
    private array $users = [
        "Christian" => "rahasia"
    ];

    public function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        return $password == $correctPassword;
    }
}