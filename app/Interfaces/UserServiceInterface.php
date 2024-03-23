<?php

namespace App\Interfaces;

interface UserServiceInterface
{
    public function register(array $data);
    public function authenticate(array $credentials);
}
