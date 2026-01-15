<?php

declare(strict_types=1);

namespace App\Repositories\Write\News;

use App\Models\News;

interface NewsWriteRepositoryInterface
{
    public function create(string $title, string $description): News;

    public function update(News $news, string $title, string $description): News;

    public function delete(News $news): void;
}
