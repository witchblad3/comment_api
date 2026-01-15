<?php

declare(strict_types=1);

namespace App\Http\Resources\VideoPost;

use App\Http\Resources\Comment\CommentResource;
use App\Services\VideoPost\Dto\ShowVideoPostResultDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class VideoPostShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var ShowVideoPostResultDto $dto */
        $dto = $this->resource;

        $commentsData = collect($dto->comments->items())
            ->map(fn ($comment) => (new CommentResource($comment))->toArray($request))
            ->values()
            ->all();

        return [
            'video_post' => (new VideoPostResource($dto->videoPost))->toArray($request),
            'comments' => [
                'data' => $commentsData,
                'per_page' => $dto->comments->perPage(),
                'next_cursor' => $dto->comments->nextCursor()?->encode(),
                'prev_cursor' => $dto->comments->previousCursor()?->encode(),
            ],
        ];
    }
}
