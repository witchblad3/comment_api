<?php

declare(strict_types=1);

namespace App\Services\News\Dto;

use App\Http\Requests\News\IndexNewsRequest;
use Spatie\LaravelData\Data;

final class IndexNewsDto extends Data
{
    public int $perPage;

    public static function fromRequest(IndexNewsRequest $request): self
    {
        return self::from([
            'perPage' => $request->getPerPage(),
        ]);
    }
}
