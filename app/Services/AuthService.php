<?php

namespace App\Services;

use App\Exceptions\ParametersErrorException;
use App\Models\User;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{

    public function login(array $attributes): string
    {
        $user = User::where('email', $attributes['email'])->first();

        if (!$user || !$user->checkPassword($attributes['password'])) {
            throw new ParametersErrorException('Credentials incorrect');
        }

        return $user->createToken($user->email)->plainTextToken;
    }

    public function logout(): bool
    {
        Auth::user()->tokens()->delete();

        return true;
    }
}
