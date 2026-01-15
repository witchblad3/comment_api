<?php

declare(strict_types=1);

namespace App\Repositories\Read\News;

use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface NewsReadRepositoryInterface
{
    public function paginate(int $perPage): LengthAwarePaginator;

    public function findOrFail(int $id): News;
}
