<?php
namespace App\Services;

use App\Interfaces\UserServiceInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $existingUser = $this->userRepository->findByEmail($data['email']);
        
        if ($existingUser) {
            return ['error' => 'User already exists', 'status' => 409];
        }
    
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);
        
        return ['user' => $user, 'status' => 201];
    }
    
    
    public function authenticate(array $credentials)
    {
        $user = $this->userRepository->findByUsername($credentials['username']);
        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('apiToken')->plainTextToken;
            return ['token' => $token];
        }
        return null;
    }
}
