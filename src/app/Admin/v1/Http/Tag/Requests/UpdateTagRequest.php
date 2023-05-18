<?php

namespace App\Admin\v1\Http\Tag\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
           'id' => $this->route('tag')?->id
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
            'name' => [
                'required',
                'string',
                'min:3',
                'max:55',
                Rule::unique('tags', 'name')->ignore($this->route('tag'))
            ]
        ];
    }
}
