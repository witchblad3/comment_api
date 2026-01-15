<?php

declare(strict_types=1);

namespace App\Services\News\Dto;

use App\Http\Requests\News\ShowNewsRequest;
use Spatie\LaravelData\Data;

final class ShowNewsDto extends Data
{
    public int $id;
    public int $commentsPerPage;
    public ?string $cursor;

    public static function fromRequest(ShowNewsRequest $request): self
    {
        return self::from([
            'id' => $request->getId(),
            'commentsPerPage' => $request->getCommentsPerPage(),
            'cursor' => $request->getCursor(),
        ]);
    }
}
