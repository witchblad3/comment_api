<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    public const EMAIL = 'email';
    public const PASSWORD = 'password';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::EMAIL => [
                'required',
                'string',
                'email'
            ],
            self::PASSWORD => [
                'required',
                'string'
            ],
        ];
    }

    public function getEmail(): string
    {
        return (string) $this->input(self::EMAIL);
    }

    public function getPassword(): string
    {
        return (string) $this->input(self::PASSWORD);
    }
}
