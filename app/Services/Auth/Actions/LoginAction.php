<?php

declare(strict_types=1);

namespace App\Services\Auth\Actions;

use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\Auth\Dto\AuthTokenResultDto;
use App\Services\Auth\Dto\LoginDto;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

final readonly class LoginAction
{
    public function __construct(
        private UserReadRepositoryInterface $userReadRepository,
    ) {}

    public function run(LoginDto $dto): AuthTokenResultDto
    {
        $user = $this->userReadRepository->findByEmail($dto->email);

        if ($user === null || !Hash::check($dto->password, (string) $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $token = $user->createToken('api')->plainTextToken;

        return AuthTokenResultDto::fromData($user, $token);
    }
}
