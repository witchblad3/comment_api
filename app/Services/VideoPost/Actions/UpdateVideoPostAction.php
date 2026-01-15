<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Actions;

use App\Models\VideoPost;
use App\Repositories\Read\VideoPost\VideoPostReadRepositoryInterface;
use App\Repositories\Write\VideoPost\VideoPostWriteRepositoryInterface;
use App\Services\VideoPost\Dto\UpdateVideoPostDto;
use Illuminate\Support\Facades\Storage;

final readonly class UpdateVideoPostAction
{
    public function __construct(
        private VideoPostReadRepositoryInterface $videoPostReadRepository,
        private VideoPostWriteRepositoryInterface $videoPostWriteRepository,
    ) {}

    public function run(UpdateVideoPostDto $dto): VideoPost
    {
        $videoPost = $this->videoPostReadRepository->findOrFail($dto->id);

        $newVideoPath = null;

        if ($dto->video !== null) {
            if (!empty($videoPost->video_path)) {
                Storage::disk('public')->delete((string) $videoPost->video_path);
            }

            $newVideoPath = $dto->video->store('videos', 'public');
        }

        return $this->videoPostWriteRepository->update(
            $videoPost,
            $dto->title,
            $dto->description,
            $newVideoPath
        );
    }
}
