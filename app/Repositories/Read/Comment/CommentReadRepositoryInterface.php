<?php

declare(strict_types=1);

namespace App\Repositories\Read\Comment;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Model;

interface CommentReadRepositoryInterface
{
    public function findOrFail(int $id): Comment;

    public function cursorPaginateForCommentable(Model $commentable, int $perPage, ?string $cursor): CursorPaginator;
}
