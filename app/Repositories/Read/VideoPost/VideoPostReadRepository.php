<?php

declare(strict_types=1);

namespace App\Repositories\Read\VideoPost;

use App\Models\VideoPost;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

final class VideoPostReadRepository implements VideoPostReadRepositoryInterface
{
    private function query(): Builder
    {
        return VideoPost::query();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->query()
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function findOrFail(int $id): VideoPost
    {
        return $this->query()->findOrFail($id);
    }
}
