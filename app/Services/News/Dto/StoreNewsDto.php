<?php

declare(strict_types=1);

namespace App\Services\News\Dto;

use App\Http\Requests\News\StoreNewsRequest;
use Spatie\LaravelData\Data;

final class StoreNewsDto extends Data
{
    public string $title;
    public string $description;

    public static function fromRequest(StoreNewsRequest $request): self
    {
        return self::from([
            'title' => $request->getTitle(),
            'description' => $request->getDescription(),
        ]);
    }
}
