<?php

declare(strict_types=1);

namespace App\Http\Resources\Auth;

use App\Services\Auth\Dto\AuthTokenResultDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class AuthTokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var AuthTokenResultDto $dto */
        $dto = $this->resource;

        return [
            'token' => (string) $dto->token,
            'user' => [
                'id' => (int) $dto->user->id,
                'name' => (string) $dto->user->name,
                'email' => (string) $dto->user->email,
            ],
        ];
    }
}
