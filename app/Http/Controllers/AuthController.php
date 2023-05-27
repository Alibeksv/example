<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthServiceInterface $service)
    {
    }

    public function login(LoginRequest $request)
    {
        $token = $this->service->login($request->validated());

        return response()->json(
            [
                'data' => $token
            ]
        );
    }

    public function logout()
    {
        $this->service->logout();

        return response()->json();
    }
}
