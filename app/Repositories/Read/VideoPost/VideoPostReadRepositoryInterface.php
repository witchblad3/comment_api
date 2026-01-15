<?php

declare(strict_types=1);

namespace App\Repositories\Read\VideoPost;

use App\Models\VideoPost;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface VideoPostReadRepositoryInterface
{
    public function paginate(int $perPage): LengthAwarePaginator;

    public function findOrFail(int $id): VideoPost;
}
