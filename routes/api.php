<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Comment\CommentController;
use App\Http\Controllers\Api\News\NewsController;
use App\Http\Controllers\Api\VideoPost\VideoPostController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (): void {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::apiResource('news', NewsController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::apiResource('video-posts', VideoPostController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

Route::apiResource('comments', CommentController::class)->only(['show']);

Route::middleware('auth:sanctum')->group(function (): void {
    Route::apiResource('comments', CommentController::class)->only(['store', 'update', 'destroy']);
});
