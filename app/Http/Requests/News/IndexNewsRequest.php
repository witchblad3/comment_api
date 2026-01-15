<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

final class IndexNewsRequest extends FormRequest
{
    public const PER_PAGE = 'per_page';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::PER_PAGE => [
                'nullable',
                'integer',
                'min:1',
                'max:100'
            ],
        ];
    }

    public function getPerPage(): int
    {
        return (int) ($this->input(self::PER_PAGE) ?? 20);
    }
}
