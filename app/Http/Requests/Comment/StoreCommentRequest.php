<?php

declare(strict_types=1);

namespace App\Http\Requests\Comment;

use App\Enums\Comment\CommentableTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class StoreCommentRequest extends FormRequest
{
    public const COMMENTABLE_TYPE = 'commentable_type';
    public const COMMENTABLE_ID = 'commentable_id';
    public const BODY = 'body';

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            self::COMMENTABLE_TYPE => [
                'required',
                'string',
                Rule::in(array_column(CommentableTypeEnum::cases(), 'value'))
            ],
            self::COMMENTABLE_ID => [
                'required',
                'integer',
                'min:1'
            ],
            self::BODY => [
                'required',
                'string',
                'min:1',
                'max:5000'
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $type = $this->input(self::COMMENTABLE_TYPE);
            $id = (int) $this->input(self::COMMENTABLE_ID);

            if ($type === null) {
                return;
            }

            try {
                $enum = CommentableTypeEnum::from((string) $type);
            } catch (\Throwable) {
                return;
            }

            $exists = DB::table($enum->table())->where('id', $id)->exists();

            if (!$exists) {
                $validator->errors()->add(self::COMMENTABLE_ID, 'commentable_id does not exist for given commentable_type');
            }
        });
    }

    public function getCommentableType(): string
    {
        return (string) $this->input(self::COMMENTABLE_TYPE);
    }

    public function getCommentableId(): int
    {
        return (int) $this->input(self::COMMENTABLE_ID);
    }

    public function getBody(): string
    {
        return (string) $this->input(self::BODY);
    }
}
