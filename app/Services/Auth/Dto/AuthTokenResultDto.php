<?php

declare(strict_types=1);

namespace App\Services\Auth\Dto;

use App\Models\User;
use Spatie\LaravelData\Data;

final class AuthTokenResultDto extends Data
{
    public User $user;
    public string $token;

    public static function fromData(User $user, string $token): self
    {
        return self::from([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
