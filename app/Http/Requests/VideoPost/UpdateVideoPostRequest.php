<?php

declare(strict_types=1);

namespace App\Http\Requests\VideoPost;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

final class UpdateVideoPostRequest extends FormRequest
{
    public const ID = 'video_post';
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';
    public const VIDEO = 'video';

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
                'exists:video_posts,id'
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
            self::VIDEO => [
                'nullable',
                'file',
                'max:204800',
                'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska'
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

    public function getVideo(): ?UploadedFile
    {
        $file = $this->file(self::VIDEO);
        return $file instanceof UploadedFile ? $file : null;
    }
}
