<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'body',
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function replies(): MorphMany
    {
        return $this->morphMany(self::class, 'commentable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
