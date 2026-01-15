<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

final class ShowNewsRequest extends FormRequest
{
    public const ID = 'news';
    public const CURSOR = 'cursor';
    public const COMMENTS_PER_PAGE = 'comments_per_page';

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
            self::CURSOR => [
                'nullable',
                'string'
            ],
            self::COMMENTS_PER_PAGE => [
                'nullable',
                'integer',
                'min:1',
                'max:100'
            ],
        ];
    }

    public function getId(): int
    {
        return (int) $this->input(self::ID);
    }

    public function getCursor(): ?string
    {
        $cursor = $this->input(self::CURSOR);
        return $cursor !== null ? (string) $cursor : null;
    }

    public function getCommentsPerPage(): int
    {
        return (int) ($this->input(self::COMMENTS_PER_PAGE) ?? 20);
    }
}
