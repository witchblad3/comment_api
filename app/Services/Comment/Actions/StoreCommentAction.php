<?php

declare(strict_types=1);

namespace App\Services\Comment\Actions;

use App\Models\Comment;
use App\Repositories\Write\Comment\CommentWriteRepositoryInterface;
use App\Services\Comment\Dto\StoreCommentDto;
use Illuminate\Database\Eloquent\Model;

final readonly class StoreCommentAction
{
    public function __construct(
        private CommentWriteRepositoryInterface $commentWriteRepository,
    ) {}

    public function run(StoreCommentDto $dto): Comment
    {
        $commentableClass = $dto->commentableType->modelClass();

        /** @var Model $commentable */
        $commentable = $commentableClass::query()->findOrFail($dto->commentableId);

        return $this->commentWriteRepository->create(
            $dto->userId,
            $commentable,
            $dto->body
        );
    }
}
