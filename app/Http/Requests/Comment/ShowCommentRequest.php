<?php

declare(strict_types=1);

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

final class ShowCommentRequest extends FormRequest
{
    public const ID = 'comment';
    public const CURSOR = 'cursor';
    public const REPLIES_PER_PAGE = 'replies_per_page';

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
                'exists:comments,id'
            ],
            self::CURSOR => [
                'nullable',
                'string'
            ],
            self::REPLIES_PER_PAGE => [
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

    public function getRepliesPerPage(): int
    {
        return (int) ($this->input(self::REPLIES_PER_PAGE) ?? 20);
    }
}
