<?php

declare(strict_types=1);

namespace App\Repositories\Write\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class CommentWriteRepository implements CommentWriteRepositoryInterface
{
    private function query(): Builder
    {
        return Comment::query();
    }

    public function create(int $userId, Model $commentable, string $body): Comment
    {
        /** @var Comment $comment */
        $comment = $this->query()->make([
            'user_id' => $userId,
            'body' => $body,
        ]);

        $comment->commentable()->associate($commentable);
        $comment->save();

        return $comment->load(['user']);
    }

    public function update(Comment $comment, string $body): Comment
    {
        $comment->update(['body' => $body]);

        return $comment->load(['user']);
    }

    public function delete(Comment $comment): void
    {
        $comment->delete();
    }
}
