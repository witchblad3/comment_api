<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\VideoPost;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoPost\DestroyVideoPostRequest;
use App\Http\Requests\VideoPost\IndexVideoPostRequest;
use App\Http\Requests\VideoPost\ShowVideoPostRequest;
use App\Http\Requests\VideoPost\StoreVideoPostRequest;
use App\Http\Requests\VideoPost\UpdateVideoPostRequest;
use App\Http\Resources\VideoPost\VideoPostResource;
use App\Http\Resources\VideoPost\VideoPostShowResource;
use App\Services\VideoPost\Actions\DeleteVideoPostAction;
use App\Services\VideoPost\Actions\IndexVideoPostAction;
use App\Services\VideoPost\Actions\ShowVideoPostAction;
use App\Services\VideoPost\Actions\StoreVideoPostAction;
use App\Services\VideoPost\Actions\UpdateVideoPostAction;
use App\Services\VideoPost\Dto\IndexVideoPostDto;
use App\Services\VideoPost\Dto\ShowVideoPostDto;
use App\Services\VideoPost\Dto\StoreVideoPostDto;
use App\Services\VideoPost\Dto\UpdateVideoPostDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class VideoPostController extends Controller
{
    public function index(IndexVideoPostRequest $request, IndexVideoPostAction $action): AnonymousResourceCollection
    {
        $paginator = $action->run(IndexVideoPostDto::fromRequest($request));

        return VideoPostResource::collection($paginator);
    }

    public function store(StoreVideoPostRequest $request, StoreVideoPostAction $action): VideoPostResource
    {
        $videoPost = $action->run(StoreVideoPostDto::fromRequest($request));

        return new VideoPostResource($videoPost);
    }

    public function show(ShowVideoPostRequest $request, ShowVideoPostAction $action): VideoPostShowResource
    {
        $result = $action->run(ShowVideoPostDto::fromRequest($request));

        return new VideoPostShowResource($result);
    }

    public function update(UpdateVideoPostRequest $request, UpdateVideoPostAction $action): VideoPostResource
    {
        $videoPost = $action->run(UpdateVideoPostDto::fromRequest($request));

        return new VideoPostResource($videoPost);
    }

    public function destroy(DestroyVideoPostRequest $request, DeleteVideoPostAction $action): JsonResponse
    {
        $action->run($request->getId());

        return response()->json(['status' => 'ok']);
    }
}
