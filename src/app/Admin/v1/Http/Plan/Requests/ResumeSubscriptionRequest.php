<?php
namespace App\Admin\v1\Http\Plan\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeSubscriptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
}
