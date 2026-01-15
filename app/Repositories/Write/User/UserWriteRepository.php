<?php

declare(strict_types=1);

namespace App\Repositories\Write\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class UserWriteRepository implements UserWriteRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    public function create(string $name, string $email, string $passwordHash): User
    {
        return $this->query()->create([
            'name' => $name,
            'email' => $email,
            'password' => $passwordHash,
        ]);
    }
}
