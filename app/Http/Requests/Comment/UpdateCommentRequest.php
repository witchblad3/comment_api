<?php

declare(strict_types=1);

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateCommentRequest extends FormRequest
{
    public const ID = 'comment';
    public const BODY = 'body';

    protected function prepareForValidation(): void
    {
        $this->merge([self::ID => (int) $this->route(self::ID)]);
    }

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            self::ID => [
                'required',
                'integer',
                'exists:comments,id'
            ],
            self::BODY => [
                'required',
                'string',
                'min:1',
                'max:5000'
            ],
        ];
    }

    public function getId(): int
    {
        return (int) $this->input(self::ID);
    }

    public function getBody(): string
    {
        return (string) $this->input(self::BODY);
    }
}
