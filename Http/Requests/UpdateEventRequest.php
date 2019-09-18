<?php

namespace Modules\Ibooking\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateEventRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'place' => 'required|min:2',
        ];
    }

    public function translationRules()
    {
        return [
            'title' => 'required|min:2',
            'description' => 'required|min:2',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'title.required' => trans('ibooking::common.messages.title is required'),
            'title.min:2'=> trans('ibooking::common.messages.title min 2 '),
            'description.required' => trans('ibooking::common.messages.description is required'),
            'description.min:2'=> trans('ibooking::common.messages.description min 2 '),
            'place.required' => trans('ibooking::common.messages.place is required'),
            'place.min:2'=> trans('ibooking::common.messages.place min 2 '),
        ];
    }

    public function translationMessages()
    {
        return [
            'title.required' => trans('ibooking::common.messages.title is required'),
            'title.min:2'=> trans('ibooking::common.messages.title min 2 '),
            'description.required' => trans('ibooking::common.messages.description is required'),
            'description.min:2'=> trans('ibooking::common.messages.description min 2 '),
            'place.required' => trans('ibooking::common.messages.place is required'),
            'place.min:2'=> trans('ibooking::common.messages.place min 2 '),
        ];
    }
}
