<?php

declare(strict_types=1);

namespace App\Http\Resources\VideoPost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

final class VideoPostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $videoUrl = null;

        if (!empty($this->video_path)) {
            $videoUrl = Storage::disk('public')->url((string) $this->video_path);
        }

        return [
            'id' => (int) $this->id,
            'title' => (string) $this->title,
            'description' => (string) $this->description,
            'video_url' => $videoUrl,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
