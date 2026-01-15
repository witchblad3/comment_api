<?php

declare(strict_types=1);

namespace App\Repositories\Write\News;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;

final class NewsWriteRepository implements NewsWriteRepositoryInterface
{
    private function query(): Builder
    {
        return News::query();
    }

    public function create(string $title, string $description): News
    {
        return $this->query()->create([
            'title' => $title,
            'description' => $description,
        ]);
    }

    public function update(News $news, string $title, string $description): News
    {
        $news->update([
            'title' => $title,
            'description' => $description,
        ]);

        return $news;
    }

    public function delete(News $news): void
    {
        $news->delete();
    }
}
