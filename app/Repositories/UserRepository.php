<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail($email)
    {
        return User::where('email', $email)->firstOrFail();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function findByUsername($username)
    {
        return User::where('username', $username)->get();
    }
}
