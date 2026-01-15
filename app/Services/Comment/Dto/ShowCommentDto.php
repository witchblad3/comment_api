<?php

declare(strict_types=1);

namespace App\Services\Comment\Dto;

use App\Http\Requests\Comment\ShowCommentRequest;
use Spatie\LaravelData\Data;

final class ShowCommentDto extends Data
{
    public int $id;
    public int $repliesPerPage;
    public ?string $cursor;

    public static function fromRequest(ShowCommentRequest $request): self
    {
        return self::from([
            'id' => $request->getId(),
            'repliesPerPage' => $request->getRepliesPerPage(),
            'cursor' => $request->getCursor(),
        ]);
    }
}
