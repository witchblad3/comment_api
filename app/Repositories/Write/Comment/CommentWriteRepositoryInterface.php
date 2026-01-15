<?php

declare(strict_types=1);

namespace App\Repositories\Write\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

interface CommentWriteRepositoryInterface
{
    public function create(int $userId, Model $commentable, string $body): Comment;

    public function update(Comment $comment, string $body): Comment;

    public function delete(Comment $comment): void;
}
