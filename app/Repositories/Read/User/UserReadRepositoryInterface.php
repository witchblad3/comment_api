<?php

declare(strict_types=1);

namespace App\Repositories\Read\User;

use App\Models\User;

interface UserReadRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
