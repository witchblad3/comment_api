<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Dto;

use App\Http\Requests\VideoPost\ShowVideoPostRequest;
use Spatie\LaravelData\Data;

final class ShowVideoPostDto extends Data
{
    public int $id;
    public int $commentsPerPage;
    public ?string $cursor;

    public static function fromRequest(ShowVideoPostRequest $request): self
    {
        return self::from([
            'id' => $request->getId(),
            'commentsPerPage' => $request->getCommentsPerPage(),
            'cursor' => $request->getCursor(),
        ]);
    }
}
