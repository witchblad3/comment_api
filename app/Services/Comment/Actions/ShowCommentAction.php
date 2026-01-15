<?php

declare(strict_types=1);

namespace App\Services\Comment\Actions;

use App\Repositories\Read\Comment\CommentReadRepositoryInterface;
use App\Services\Comment\Dto\ShowCommentDto;
use App\Services\Comment\Dto\ShowCommentResultDto;

final readonly class ShowCommentAction
{
    public function __construct(
        private CommentReadRepositoryInterface $commentReadRepository,
    ) {}

    public function run(ShowCommentDto $dto): ShowCommentResultDto
    {
        $comment = $this->commentReadRepository->findOrFail($dto->id);

        $replies = $this->commentReadRepository->cursorPaginateForCommentable(
            $comment,
            $dto->repliesPerPage,
            $dto->cursor
        );

        return ShowCommentResultDto::fromData($comment, $replies);
    }
}
