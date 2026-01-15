<?php

declare(strict_types=1);

namespace App\Http\Resources\News;

use App\Http\Resources\Comment\CommentResource;
use App\Services\News\Dto\ShowNewsResultDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class NewsShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var ShowNewsResultDto $dto */
        $dto = $this->resource;

        $commentsData = collect($dto->comments->items())
            ->map(fn ($comment) => (new CommentResource($comment))->toArray($request))
            ->values()
            ->all();

        return [
            'news' => (new NewsResource($dto->news))->toArray($request),
            'comments' => [
                'data' => $commentsData,
                'per_page' => $dto->comments->perPage(),
                'next_cursor' => $dto->comments->nextCursor()?->encode(),
                'prev_cursor' => $dto->comments->previousCursor()?->encode(),
            ],
        ];
    }
}
