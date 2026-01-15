<?php

declare(strict_types=1);

namespace App\Repositories\Write\VideoPost;

use App\Models\VideoPost;
use Illuminate\Database\Eloquent\Builder;

final class VideoPostWriteRepository implements VideoPostWriteRepositoryInterface
{
    private function query(): Builder
    {
        return VideoPost::query();
    }

    public function create(string $title, string $description, ?string $videoPath): VideoPost
    {
        return $this->query()->create([
            'title' => $title,
            'description' => $description,
            'video_path' => $videoPath,
        ]);
    }

    public function update(VideoPost $videoPost, string $title, string $description, ?string $videoPath): VideoPost
    {
        $payload = [
            'title' => $title,
            'description' => $description,
        ];

        if ($videoPath !== null) {
            $payload['video_path'] = $videoPath;
        }

        $videoPost->update($payload);

        return $videoPost;
    }

    public function delete(VideoPost $videoPost): void
    {
        $videoPost->delete();
    }
}
