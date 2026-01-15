<?php

declare(strict_types=1);

namespace App\Repositories\Write\User;

use App\Models\User;

interface UserWriteRepositoryInterface
{
    public function create(string $name, string $email, string $passwordHash): User;
}
