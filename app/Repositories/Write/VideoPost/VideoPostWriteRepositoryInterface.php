<?php

declare(strict_types=1);

namespace App\Repositories\Write\VideoPost;

use App\Models\VideoPost;

interface VideoPostWriteRepositoryInterface
{
    public function create(string $title, string $description, ?string $videoPath): VideoPost;

    public function update(VideoPost $videoPost, string $title, string $description, ?string $videoPath): VideoPost;

    public function delete(VideoPost $videoPost): void;
}
