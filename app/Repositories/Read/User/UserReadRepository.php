<?php

declare(strict_types=1);

namespace App\Repositories\Read\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class UserReadRepository implements UserReadRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->query()->where('email', $email)->first();
    }
}
