<?php

namespace App\Services\Contracts;

interface AuthServiceInterface
{
    public function login(array $attributes): string;

    public function logout(): bool;
}
