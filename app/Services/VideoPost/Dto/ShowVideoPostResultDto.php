<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Dto;

use App\Models\VideoPost;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Spatie\LaravelData\Data;

final class ShowVideoPostResultDto extends Data
{
    public VideoPost $videoPost;
    public CursorPaginator $comments;

    public static function fromData(VideoPost $videoPost, CursorPaginator $comments): self
    {
        return self::from([
            'videoPost' => $videoPost,
            'comments' => $comments,
        ]);
    }
}
