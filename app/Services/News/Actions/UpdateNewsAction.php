<?php

declare(strict_types=1);

namespace App\Services\News\Actions;

use App\Models\News;
use App\Repositories\Read\News\NewsReadRepositoryInterface;
use App\Repositories\Write\News\NewsWriteRepositoryInterface;
use App\Services\News\Dto\UpdateNewsDto;

final readonly class UpdateNewsAction
{
    public function __construct(
        private NewsReadRepositoryInterface $newsReadRepository,
        private NewsWriteRepositoryInterface $newsWriteRepository,
    ) {}

    public function run(UpdateNewsDto $dto): News
    {
        $news = $this->newsReadRepository->findOrFail($dto->id);

        return $this->newsWriteRepository->update($news, $dto->title, $dto->description);
    }
}
