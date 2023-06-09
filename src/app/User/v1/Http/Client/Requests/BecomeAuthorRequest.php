<?php
namespace App\User\v1\Http\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class BecomeAuthorRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => request()->user()->id
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
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3', 'max:255']
        ];
    }
}
