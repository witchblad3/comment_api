<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Read\Comment\CommentReadRepository;
use App\Repositories\Read\Comment\CommentReadRepositoryInterface;
use App\Repositories\Read\News\NewsReadRepository;
use App\Repositories\Read\News\NewsReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepository;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Read\VideoPost\VideoPostReadRepository;
use App\Repositories\Read\VideoPost\VideoPostReadRepositoryInterface;
use App\Repositories\Write\Comment\CommentWriteRepository;
use App\Repositories\Write\Comment\CommentWriteRepositoryInterface;
use App\Repositories\Write\News\NewsWriteRepository;
use App\Repositories\Write\News\NewsWriteRepositoryInterface;
use App\Repositories\Write\User\UserWriteRepository;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Repositories\Write\VideoPost\VideoPostWriteRepository;
use App\Repositories\Write\VideoPost\VideoPostWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(NewsReadRepositoryInterface::class, NewsReadRepository::class);
        $this->app->bind(NewsWriteRepositoryInterface::class, NewsWriteRepository::class);

        $this->app->bind(VideoPostReadRepositoryInterface::class, VideoPostReadRepository::class);
        $this->app->bind(VideoPostWriteRepositoryInterface::class, VideoPostWriteRepository::class);

        $this->app->bind(CommentReadRepositoryInterface::class, CommentReadRepository::class);
        $this->app->bind(CommentWriteRepositoryInterface::class, CommentWriteRepository::class);

        $this->app->bind(UserReadRepositoryInterface::class, UserReadRepository::class);
        $this->app->bind(UserWriteRepositoryInterface::class, UserWriteRepository::class);
    }
}
