<?php

declare(strict_types=1);

namespace App\Services\Auth\Actions;

use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Services\Auth\Dto\AuthTokenResultDto;
use App\Services\Auth\Dto\RegisterDto;
use Illuminate\Support\Facades\Hash;

final readonly class RegisterAction
{
    public function __construct(
        private UserWriteRepositoryInterface $userWriteRepository,
    ) {}

    public function run(RegisterDto $dto): AuthTokenResultDto
    {
        $user = $this->userWriteRepository->create(
            $dto->name,
            $dto->email,
            Hash::make($dto->password),
        );

        $token = $user->createToken('api')->plainTextToken;

        return AuthTokenResultDto::fromData($user, $token);
    }
}
