<?php

declare(strict_types=1);

namespace App\Services\Comment\Dto;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Spatie\LaravelData\Data;

final class ShowCommentResultDto extends Data
{
    public Comment $comment;
    public CursorPaginator $replies;

    public static function fromData(Comment $comment, CursorPaginator $replies): self
    {
        return self::from([
            'comment' => $comment,
            'replies' => $replies,
        ]);
    }
}
