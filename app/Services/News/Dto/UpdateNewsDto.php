<?php

declare(strict_types=1);

namespace App\Services\News\Dto;

use App\Http\Requests\News\UpdateNewsRequest;
use Spatie\LaravelData\Data;

final class UpdateNewsDto extends Data
{
    public int $id;
    public string $title;
    public string $description;

    public static function fromRequest(UpdateNewsRequest $request): self
    {
        return self::from([
            'id' => $request->getId(),
            'title' => $request->getTitle(),
            'description' => $request->getDescription(),
        ]);
    }
}
