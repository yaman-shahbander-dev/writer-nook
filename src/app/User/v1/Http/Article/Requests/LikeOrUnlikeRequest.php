<?php

namespace App\User\v1\Http\Article\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shared\Enums\MorphEnum;

class LikeOrUnlikeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
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
            'likeable_type' => MorphEnum::ARTICLE->value,
            'likeable_id' => $this->article_id
        ]);
    }
}
