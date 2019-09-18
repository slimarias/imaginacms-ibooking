<?php

namespace Modules\Ibooking\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateDayRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'num' => 'required',
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
            'num.required' => trans('ibooking::days.messages.num is required'),
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
