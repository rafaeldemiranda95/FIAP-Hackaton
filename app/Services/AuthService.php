<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate($username, $password)
    {
        $user = $this->userRepository->findByUsername($username);

        if (!$user || !Hash::check($password, $user->password)) {
            return false;
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return ['token' => $token];
    }
}
