<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateNewsRequest extends FormRequest
{
    public const ID = 'news';
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';

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
        return [
            self::ID => [
                'required',
                'integer',
                'exists:news,id'
            ],
            self::TITLE => [
                'required',
                'string',
                'max:255'
            ],
            self::DESCRIPTION => [
                'required',
                'string'
            ],
        ];
    }

    public function getId(): int
    {
        return (int) $this->input(self::ID);
    }

    public function getTitle(): string
    {
        return (string) $this->input(self::TITLE);
    }

    public function getDescription(): string
    {
        return (string) $this->input(self::DESCRIPTION);
    }
}
