<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

final class StoreNewsRequest extends FormRequest
{
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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

    public function getTitle(): string
    {
        return (string) $this->input(self::TITLE);
    }

    public function getDescription(): string
    {
        return (string) $this->input(self::DESCRIPTION);
    }
}
