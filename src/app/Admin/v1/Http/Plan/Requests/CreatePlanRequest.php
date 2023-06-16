<?php
namespace App\Admin\v1\Http\Plan\Requests;

use Domain\Plan\Enums\DurationTypes;
use Domain\Plan\Enums\PlanTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreatePlanRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => [
                'required',
                new Enum(PlanTypes::class)
            ],
            'duration' => [
                'required',
                new Enum(DurationTypes::class)
            ],
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('plans', 'name')
            ],
            'description' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'base_price' => [
                'required',
                'numeric'
            ],
            'discount' => [
                'required',
                'numeric'
            ],
            'features' => [
                'required',
                'array',
                'min:1'
            ],
            'features.*.id' => [
                'required',
                'uuid',
                Rule::exists('features', 'id')->withoutTrashed()
            ],
            'features.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ]
        ];
    }
}
