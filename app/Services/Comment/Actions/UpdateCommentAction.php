<?php

declare(strict_types=1);

namespace App\Services\Comment\Actions;

use App\Models\Comment;
use App\Repositories\Read\Comment\CommentReadRepositoryInterface;
use App\Repositories\Write\Comment\CommentWriteRepositoryInterface;
use App\Services\Comment\Dto\UpdateCommentDto;

final readonly class UpdateCommentAction
{
    public function __construct(
        private CommentReadRepositoryInterface $commentReadRepository,
        private CommentWriteRepositoryInterface $commentWriteRepository,
    ) {}

    public function run(UpdateCommentDto $dto): Comment
    {
        $comment = $this->commentReadRepository->findOrFail($dto->id);

        return $this->commentWriteRepository->update($comment, $dto->body);
    }
}
