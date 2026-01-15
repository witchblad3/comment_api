<?php

declare(strict_types=1);

namespace App\Services\News\Actions;

use App\Repositories\Read\News\NewsReadRepositoryInterface;
use App\Repositories\Write\News\NewsWriteRepositoryInterface;

final readonly class DeleteNewsAction
{
    public function __construct(
        private NewsReadRepositoryInterface $newsReadRepository,
        private NewsWriteRepositoryInterface $newsWriteRepository,
    ) {}

    public function run(int $id): void
    {
        $news = $this->newsReadRepository->findOrFail($id);

        $this->newsWriteRepository->delete($news);
    }
}
