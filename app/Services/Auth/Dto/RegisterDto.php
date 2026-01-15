<?php

declare(strict_types=1);

namespace App\Services\Auth\Dto;

use App\Http\Requests\Auth\RegisterRequest;
use Spatie\LaravelData\Data;

final class RegisterDto extends Data
{
    public string $name;
    public string $email;
    public string $password;

    public static function fromRequest(RegisterRequest $request): self
    {
        return self::from([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
        ]);
    }
}
