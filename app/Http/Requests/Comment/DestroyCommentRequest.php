<?php

declare(strict_types=1);

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

final class DestroyCommentRequest extends FormRequest
{
    public const ID = 'comment';

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
        return [self::ID => [
            'required',
            'integer',
            'exists:comments,id'
        ]];
    }

    public function getId(): int
    {
        return (int) $this->input(self::ID);
    }
}
