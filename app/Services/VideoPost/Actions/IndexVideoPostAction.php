<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Actions;

use App\Repositories\Read\VideoPost\VideoPostReadRepositoryInterface;
use App\Services\VideoPost\Dto\IndexVideoPostDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class IndexVideoPostAction
{
    public function __construct(
        private VideoPostReadRepositoryInterface $videoPostReadRepository,
    ) {}

    public function run(IndexVideoPostDto $dto): LengthAwarePaginator
    {
        return $this->videoPostReadRepository->paginate($dto->perPage);
    }
}
