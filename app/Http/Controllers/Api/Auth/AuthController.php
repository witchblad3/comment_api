<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\AuthTokenResource;
use App\Services\Auth\Actions\LoginAction;
use App\Services\Auth\Actions\RegisterAction;
use App\Services\Auth\Dto\LoginDto;
use App\Services\Auth\Dto\RegisterDto;

final class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterAction $action): AuthTokenResource
    {
        $result = $action->run(RegisterDto::fromRequest($request));

        return new AuthTokenResource($result);
    }

    public function login(LoginRequest $request, LoginAction $action): AuthTokenResource
    {
        $result = $action->run(LoginDto::fromRequest($request));

        return new AuthTokenResource($result);
    }
}
