<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class VideoPost extends Model
{
    protected $table = 'video_posts';

    protected $fillable = [
        'title',
        'description',
        'video_path',
    ];

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
