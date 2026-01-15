<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Comment;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Comment::class => CommentPolicy::class,
    ];
}
