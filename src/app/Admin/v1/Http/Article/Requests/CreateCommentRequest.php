<?php

namespace App\Admin\v1\Http\Article\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shared\Enums\MorphEnum;

class CreateCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'comment' => [
                'required',
                'string'
            ],
            'article_id' => [
                'required',
                'uuid',
                Rule::exists('articles', 'id')->withoutTrashed()
            ]
        ];
    }

    public function passedValidation()
    {
        $this->replace([
            'user_id' => request()?->user()?->id,
            'comment' => $this->comment,
            'commentable_type' => MorphEnum::ARTICLE->value,
            'commentable_id' => $this->article_id
        ]);
    }
}
