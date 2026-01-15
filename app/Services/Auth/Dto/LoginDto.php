<?php

declare(strict_types=1);

namespace App\Services\Auth\Dto;

use App\Http\Requests\Auth\LoginRequest;
use Spatie\LaravelData\Data;

final class LoginDto extends Data
{
    public string $email;
    public string $password;

    public static function fromRequest(LoginRequest $request): self
    {
        return self::from([
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
        ]);
    }
}
