<?php

declare(strict_types=1);

namespace App\Services\Comment\Actions;

use App\Repositories\Read\Comment\CommentReadRepositoryInterface;
use App\Repositories\Write\Comment\CommentWriteRepositoryInterface;

final readonly class DeleteCommentAction
{
    public function __construct(
        private CommentReadRepositoryInterface $commentReadRepository,
        private CommentWriteRepositoryInterface $commentWriteRepository,
    ) {}

    public function run(int $id): void
    {
        $comment = $this->commentReadRepository->findOrFail($id);

        $this->commentWriteRepository->delete($comment);
    }
}
