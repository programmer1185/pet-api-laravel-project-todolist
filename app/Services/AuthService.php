<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\DTO\LoginDto;
use App\DTO\RegisterDto;

class AuthService {

    public function login(LoginDto $loginDto): array
    {
        if (Auth::attempt($loginDto->toArray())) {
            return $this->createAuthToken();
        }

        return ['token' => null];
    }

    public function register(RegisterDto $registerDto): array
    {
        $candidate = User::where('email', $registerDto->email)->first();

        if (!$candidate) {
            $registerDto->password = Hash::make($registerDto->password);
            $user = User::create($registerDto->toArray());
            Auth::login($user);

            return $this->createAuthToken();
        }

        return ['token' => null];
    }

    private function createAuthToken(): array
    {
        $token = Auth::user()->createToken('auth');

        return ['token' => $token->plainTextToken];
    }

}
