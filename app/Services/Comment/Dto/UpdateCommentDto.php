<?php

declare(strict_types=1);

namespace App\Services\Comment\Dto;

use App\Http\Requests\Comment\UpdateCommentRequest;
use Spatie\LaravelData\Data;

final class UpdateCommentDto extends Data
{
    public int $id;
    public string $body;

    public static function fromRequest(UpdateCommentRequest $request): self
    {
        return self::from([
            'id' => $request->getId(),
            'body' => $request->getBody(),
        ]);
    }
}
