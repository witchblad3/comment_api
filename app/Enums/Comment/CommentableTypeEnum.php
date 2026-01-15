<?php

declare(strict_types=1);

namespace App\Enums\Comment;

use App\Models\Comment;
use App\Models\News;
use App\Models\VideoPost;

enum CommentableTypeEnum: string
{
    case NEWS = 'news';
    case VIDEO_POST = 'video_post';
    case COMMENT = 'comment';

    public function modelClass(): string
    {
        return match ($this) {
            self::NEWS => News::class,
            self::VIDEO_POST => VideoPost::class,
            self::COMMENT => Comment::class,
        };
    }

    public function table(): string
    {
        return match ($this) {
            self::NEWS => 'news',
            self::VIDEO_POST => 'video_posts',
            self::COMMENT => 'comments',
        };
    }
}
