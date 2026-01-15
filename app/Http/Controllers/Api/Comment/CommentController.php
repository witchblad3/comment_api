<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\DestroyCommentRequest;
use App\Http\Requests\Comment\ShowCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Comment\CommentShowResource;
use App\Repositories\Read\Comment\CommentReadRepositoryInterface;
use App\Services\Comment\Actions\DeleteCommentAction;
use App\Services\Comment\Actions\ShowCommentAction;
use App\Services\Comment\Actions\StoreCommentAction;
use App\Services\Comment\Actions\UpdateCommentAction;
use App\Services\Comment\Dto\ShowCommentDto;
use App\Services\Comment\Dto\StoreCommentDto;
use App\Services\Comment\Dto\UpdateCommentDto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

final class CommentController extends Controller
{
    use AuthorizesRequests;
    public function store(StoreCommentRequest $request, StoreCommentAction $action): CommentResource
    {
        $comment = $action->run(StoreCommentDto::fromRequest($request));

        return new CommentResource($comment);
    }

    public function show(ShowCommentRequest $request, ShowCommentAction $action): CommentShowResource
    {
        $result = $action->run(ShowCommentDto::fromRequest($request));

        return new CommentShowResource($result);
    }

    public function update(
        UpdateCommentRequest $request,
        UpdateCommentAction $action,
        CommentReadRepositoryInterface $commentReadRepository
    ): CommentResource {
        $comment = $commentReadRepository->findOrFail($request->getId());
        $this->authorize('update', $comment);

        $updated = $action->run(UpdateCommentDto::fromRequest($request));

        return new CommentResource($updated);
    }

    public function destroy(
        DestroyCommentRequest $request,
        DeleteCommentAction $action,
        CommentReadRepositoryInterface $commentReadRepository
    ): JsonResponse {
        $comment = $commentReadRepository->findOrFail($request->getId());
        $this->authorize('delete', $comment);

        $action->run($request->getId());

        return response()->json(['status' => 'ok']);
    }
}
