<?php

declare(strict_types=1);

namespace App\Http\Resources\Comment;

use App\Services\Comment\Dto\ShowCommentResultDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class CommentShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var ShowCommentResultDto $dto */
        $dto = $this->resource;

        $repliesData = collect($dto->replies->items())
            ->map(fn ($comment) => (new CommentResource($comment))->toArray($request))
            ->values()
            ->all();

        return [
            'comment' => (new CommentResource($dto->comment))->toArray($request),
            'replies' => [
                'data' => $repliesData,
                'per_page' => $dto->replies->perPage(),
                'next_cursor' => $dto->replies->nextCursor()?->encode(),
                'prev_cursor' => $dto->replies->previousCursor()?->encode(),
            ],
        ];
    }
}
