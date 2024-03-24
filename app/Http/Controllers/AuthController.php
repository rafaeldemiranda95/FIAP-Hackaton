<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function register(Request $request, UserService $userService)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $result = $userService->register($request->all());

            if (isset($result['error'])) {
                return response()->json(['message' => $result['error']], $result['status']);
            }

            return response()->json(['message' => 'User successfully registered', 'user' => $result['user']], $result['status']);
        } catch (\Exception $e) {
            // Resposta em caso de erro
            return response()->json([
                'mensagem' => 'Erro ao registrar usuário: ' . $e->getMessage(),
            ], 500);
        }
    }
}
