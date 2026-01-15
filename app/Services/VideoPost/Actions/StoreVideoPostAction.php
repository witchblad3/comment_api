<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Actions;

use App\Models\VideoPost;
use App\Repositories\Write\VideoPost\VideoPostWriteRepositoryInterface;
use App\Services\VideoPost\Dto\StoreVideoPostDto;

final readonly class StoreVideoPostAction
{
    public function __construct(
        private VideoPostWriteRepositoryInterface $videoPostWriteRepository,
    ) {}

    public function run(StoreVideoPostDto $dto): VideoPost
    {
        $videoPath = $dto->video?->store('videos', 'public');

        return $this->videoPostWriteRepository->create(
            $dto->title,
            $dto->description,
            $videoPath
        );
    }
}
