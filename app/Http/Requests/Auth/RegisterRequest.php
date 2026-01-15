<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class RegisterRequest extends FormRequest
{
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::NAME => [
                'required',
                'string',
                'max:255'
            ],
            self::EMAIL => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')
            ],
            self::PASSWORD => [
                'required',
                'string',
                'min:6',
                'confirmed'
            ],
        ];
    }

    public function getName(): string
    {
        return (string) $this->input(self::NAME);
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
