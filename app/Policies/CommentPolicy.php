<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

final class CommentPolicy
{
    public function update(User $user, Comment $comment): bool
    {
        return (int) $comment->user_id === (int) $user->id;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return (int) $comment->user_id === (int) $user->id;
    }
}
