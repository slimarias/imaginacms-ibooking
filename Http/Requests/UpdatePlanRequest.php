<?php

namespace Modules\Ibooking\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdatePlanRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'event_id' => 'required',
        ];
    }

    public function translationRules()
    {
        return [
            'title' => 'required|min:2',
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
            'event_id.required' => trans('ibooking::events.messages.event is required'),
        ];
    }

    public function translationMessages()
    {
        return [
            'title.required' => trans('ibooking::common.messages.title is required'),
            'title.min:2'=> trans('ibooking::common.messages.title min 2 '),
            'event_id.required' => trans('ibooking::events.messages.event is required'),
        ];
    }
}
