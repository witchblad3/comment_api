<?php

declare(strict_types=1);

namespace App\Http\Requests\VideoPost;

use Illuminate\Foundation\Http\FormRequest;

final class DestroyVideoPostRequest extends FormRequest
{
    public const ID = 'video_post';

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
        return [self::ID => [
            'required',
            'integer',
            'exists:video_posts,id'
        ]];
    }

    public function getId(): int
    {
        return (int) $this->input(self::ID);
    }
}
