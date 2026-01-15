<?php

declare(strict_types=1);

namespace App\Services\News\Actions;

use App\Models\News;
use App\Repositories\Write\News\NewsWriteRepositoryInterface;
use App\Services\News\Dto\StoreNewsDto;

final readonly class StoreNewsAction
{
    public function __construct(
        private NewsWriteRepositoryInterface $newsWriteRepository,
    ) {}

    public function run(StoreNewsDto $dto): News
    {
        return $this->newsWriteRepository->create($dto->title, $dto->description);
    }
}
