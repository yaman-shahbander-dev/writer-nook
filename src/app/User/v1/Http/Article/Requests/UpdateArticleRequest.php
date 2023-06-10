<?php

namespace App\User\v1\Http\Article\Requests;

use Domain\Article\Enums\ArticleStates;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateArticleRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => request()->user()->id,
            'id' => $this->route('article')->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'min:3',
                'max:255',
                'string',
                Rule::unique('articles', 'title')
                    ->ignore($this->route('article'))
            ],
            'content' => ['required'],
            'hashed_content' => ['required'],
            'excerpt' => ['required', 'string'],
            'categories' => ['required', 'array', 'min:1'],
            'tags' => ['required', 'array', 'min:1'],
            'categories.*.id' => [
                'required',
                'uuid',
                Rule::exists('categories', 'id')
                    ->withoutTrashed()
            ],
            'tags.*.id' => [
                'required',
                'uuid',
                Rule::exists('tags', 'id')
                    ->withoutTrashed()
            ],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,gif', 'max:2048']
        ];
    }
}
