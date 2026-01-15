<?php

declare(strict_types=1);

namespace App\Services\News\Actions;

use App\Repositories\Read\Comment\CommentReadRepositoryInterface;
use App\Repositories\Read\News\NewsReadRepositoryInterface;
use App\Services\News\Dto\ShowNewsDto;
use App\Services\News\Dto\ShowNewsResultDto;

final readonly class ShowNewsAction
{
    public function __construct(
        private NewsReadRepositoryInterface $newsReadRepository,
        private CommentReadRepositoryInterface $commentReadRepository,
    ) {}

    public function run(ShowNewsDto $dto): ShowNewsResultDto
    {
        $news = $this->newsReadRepository->findOrFail($dto->id);

        $comments = $this->commentReadRepository->cursorPaginateForCommentable(
            $news,
            $dto->commentsPerPage,
            $dto->cursor
        );

        return ShowNewsResultDto::fromData($news, $comments);
    }
}
