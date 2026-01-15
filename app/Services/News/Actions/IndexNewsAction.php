<?php

declare(strict_types=1);

namespace App\Services\News\Actions;

use App\Repositories\Read\News\NewsReadRepositoryInterface;
use App\Services\News\Dto\IndexNewsDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class IndexNewsAction
{
    public function __construct(
        private NewsReadRepositoryInterface $newsReadRepository,
    ) {}

    public function run(IndexNewsDto $dto): LengthAwarePaginator
    {
        return $this->newsReadRepository->paginate($dto->perPage);
    }
}
