<?php

declare(strict_types=1);

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'user_id' => (int) $this->user_id,
            'body' => (string) $this->body,
            'commentable_type' => (string) $this->commentable_type,
            'commentable_id' => (int) $this->commentable_id,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'user' => $this->whenLoaded('user', fn () => [
                'id' => (int) $this->user->id,
                'name' => (string) $this->user->name,
                'email' => (string) $this->user->email,
            ]),
        ];
    }
}
