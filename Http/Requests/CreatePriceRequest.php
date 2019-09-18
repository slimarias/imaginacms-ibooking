<?php

namespace Modules\Ibooking\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreatePriceRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'plan_id' => 'required',
            'price' => 'required',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'plan_id.required' => trans('ibooking::prices.messages.plan is required'),
            'price.required' => trans('ibooking::prices.messages.price is required'),
        ];
    }

    public function translationMessages()
    {
        return [
            'plan_id.required' => trans('ibooking::prices.messages.plan is required'),
            'price.required' => trans('ibooking::prices.messages.price is required'),
        ];
    }
}
