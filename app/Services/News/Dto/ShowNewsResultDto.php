<?php

declare(strict_types=1);

namespace App\Services\News\Dto;

use App\Models\News;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Spatie\LaravelData\Data;

final class ShowNewsResultDto extends Data
{
    public News $news;
    public CursorPaginator $comments;

    public static function fromData(News $news, CursorPaginator $comments): self
    {
        return self::from([
            'news' => $news,
            'comments' => $comments,
        ]);
    }
}
