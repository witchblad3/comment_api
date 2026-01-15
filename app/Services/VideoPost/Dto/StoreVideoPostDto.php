<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Dto;

use App\Http\Requests\VideoPost\StoreVideoPostRequest;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

final class StoreVideoPostDto extends Data
{
    public string $title;
    public string $description;
    public ?UploadedFile $video;

    public static function fromRequest(StoreVideoPostRequest $request): self
    {
        return self::from([
            'title' => $request->getTitle(),
            'description' => $request->getDescription(),
            'video' => $request->getVideo(),
        ]);
    }
}
