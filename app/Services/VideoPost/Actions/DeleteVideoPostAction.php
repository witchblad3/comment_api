<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Actions;

use App\Repositories\Read\VideoPost\VideoPostReadRepositoryInterface;
use App\Repositories\Write\VideoPost\VideoPostWriteRepositoryInterface;
use Illuminate\Support\Facades\Storage;

final readonly class DeleteVideoPostAction
{
    public function __construct(
        private VideoPostReadRepositoryInterface $videoPostReadRepository,
        private VideoPostWriteRepositoryInterface $videoPostWriteRepository,
    ) {}

    public function run(int $id): void
    {
        $videoPost = $this->videoPostReadRepository->findOrFail($id);

        if (!empty($videoPost->video_path)) {
            Storage::disk('public')->delete((string) $videoPost->video_path);
        }

        $this->videoPostWriteRepository->delete($videoPost);
    }
}
