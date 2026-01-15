<?php

declare(strict_types=1);

namespace App\Services\Comment\Dto;

use App\Enums\Comment\CommentableTypeEnum;
use App\Http\Requests\Comment\StoreCommentRequest;
use Spatie\LaravelData\Data;

final class StoreCommentDto extends Data
{
    public int $userId;
    public CommentableTypeEnum $commentableType;
    public int $commentableId;
    public string $body;

    public static function fromRequest(StoreCommentRequest $request): self
    {
        return self::from([
            'userId' => (int) $request->user()->id,
            'commentableType' => CommentableTypeEnum::from($request->getCommentableType()),
            'commentableId' => $request->getCommentableId(),
            'body' => $request->getBody(),
        ]);
    }
}
