<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Actions;

use App\Repositories\Read\Comment\CommentReadRepositoryInterface;
use App\Repositories\Read\VideoPost\VideoPostReadRepositoryInterface;
use App\Services\VideoPost\Dto\ShowVideoPostDto;
use App\Services\VideoPost\Dto\ShowVideoPostResultDto;

final readonly class ShowVideoPostAction
{
    public function __construct(
        private VideoPostReadRepositoryInterface $videoPostReadRepository,
        private CommentReadRepositoryInterface $commentReadRepository,
    ) {}

    public function run(ShowVideoPostDto $dto): ShowVideoPostResultDto
    {
        $videoPost = $this->videoPostReadRepository->findOrFail($dto->id);

        $comments = $this->commentReadRepository->cursorPaginateForCommentable(
            $videoPost,
            $dto->commentsPerPage,
            $dto->cursor
        );

        return ShowVideoPostResultDto::fromData($videoPost, $comments);
    }
}
