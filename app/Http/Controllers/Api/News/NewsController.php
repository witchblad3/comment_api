<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\DestroyNewsRequest;
use App\Http\Requests\News\IndexNewsRequest;
use App\Http\Requests\News\ShowNewsRequest;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\News\NewsResource;
use App\Http\Resources\News\NewsShowResource;
use App\Services\News\Actions\DeleteNewsAction;
use App\Services\News\Actions\IndexNewsAction;
use App\Services\News\Actions\ShowNewsAction;
use App\Services\News\Actions\StoreNewsAction;
use App\Services\News\Actions\UpdateNewsAction;
use App\Services\News\Dto\IndexNewsDto;
use App\Services\News\Dto\ShowNewsDto;
use App\Services\News\Dto\StoreNewsDto;
use App\Services\News\Dto\UpdateNewsDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class NewsController extends Controller
{
    public function index(IndexNewsRequest $request, IndexNewsAction $action): AnonymousResourceCollection
    {
        $paginator = $action->run(IndexNewsDto::fromRequest($request));

        return NewsResource::collection($paginator);
    }

    public function store(StoreNewsRequest $request, StoreNewsAction $action): NewsResource
    {
        $news = $action->run(StoreNewsDto::fromRequest($request));

        return new NewsResource($news);
    }

    public function show(ShowNewsRequest $request, ShowNewsAction $action): NewsShowResource
    {
        $result = $action->run(ShowNewsDto::fromRequest($request));

        return new NewsShowResource($result);
    }

    public function update(UpdateNewsRequest $request, UpdateNewsAction $action): NewsResource
    {
        $news = $action->run(UpdateNewsDto::fromRequest($request));

        return new NewsResource($news);
    }

    public function destroy(DestroyNewsRequest $request, DeleteNewsAction $action): JsonResponse
    {
        $action->run($request->getId());

        return response()->json(['status' => 'ok']);
    }
}
