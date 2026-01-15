<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Dto;

use App\Http\Requests\VideoPost\UpdateVideoPostRequest;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

final class UpdateVideoPostDto extends Data
{
    public int $id;
    public string $title;
    public string $description;
    public ?UploadedFile $video;

    public static function fromRequest(UpdateVideoPostRequest $request): self
    {
        return self::from([
            'id' => $request->getId(),
            'title' => $request->getTitle(),
            'description' => $request->getDescription(),
            'video' => $request->getVideo(),
        ]);
    }
}
