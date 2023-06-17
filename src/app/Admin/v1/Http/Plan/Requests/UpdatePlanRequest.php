<?php
namespace App\Admin\v1\Http\Plan\Requests;

use Domain\Plan\Enums\DurationTypes;
use Domain\Plan\Enums\PlanTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdatePlanRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => request()->route('plan')?->id
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
            'stripe_price_plan' => [
                'required',
                'string'
            ],
            'stripe_product_id' => [
                'required',
                'string'
            ],
            'type' => [
                'required',
                new Enum(PlanTypes::class)
            ],
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('plans', 'name')->ignore(request()->route('plan')?->id)
            ],
            'description' => [
                'required',
                'string',
                'min:3',
                'max:255'
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
