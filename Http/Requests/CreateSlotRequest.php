<?php

namespace Modules\Ibooking\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateSlotRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'hour' => 'required',
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
            'hour.required' => trans('ibooking::hour.messages.hour is required'),
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
