<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

final class DestroyNewsRequest extends FormRequest
{
    public const ID = 'news';

    protected function prepareForValidation(): void
    {
        $this->merge([self::ID => (int) $this->route(self::ID)]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [self::ID => ['required', 'integer', 'exists:news,id']];
    }

    public function getId(): int
    {
        return (int) $this->input(self::ID);
    }
}
