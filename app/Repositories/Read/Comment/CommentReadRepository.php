<?php

declare(strict_types=1);

namespace App\Repositories\Read\Comment;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class CommentReadRepository implements CommentReadRepositoryInterface
{
    private function query(): Builder
    {
        return Comment::query();
    }

    public function findOrFail(int $id): Comment
    {
        return $this->query()->with(['user'])->findOrFail($id);
    }

    public function cursorPaginateForCommentable(Model $commentable, int $perPage, ?string $cursor): CursorPaginator
    {
        return $this->query()
            ->where('commentable_type', $commentable->getMorphClass())
            ->where('commentable_id', $commentable->getKey())
            ->with(['user'])
            ->orderByDesc('id')
            ->cursorPaginate($perPage, ['*'], 'cursor', $cursor);
    }
}
