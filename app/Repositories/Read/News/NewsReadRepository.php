<?php

declare(strict_types=1);

namespace App\Repositories\Read\News;

use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

final class NewsReadRepository implements NewsReadRepositoryInterface
{
    private function query(): Builder
    {
        return News::query();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->query()
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function findOrFail(int $id): News
    {
        return $this->query()->findOrFail($id);
    }
}
