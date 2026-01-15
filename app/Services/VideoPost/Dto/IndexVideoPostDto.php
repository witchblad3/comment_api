<?php

declare(strict_types=1);

namespace App\Services\VideoPost\Dto;

use App\Http\Requests\VideoPost\IndexVideoPostRequest;
use Spatie\LaravelData\Data;

final class IndexVideoPostDto extends Data
{
    public int $perPage;

    public static function fromRequest(IndexVideoPostRequest $request): self
    {
        return self::from([
            'perPage' => $request->getPerPage(),
        ]);
    }
}
