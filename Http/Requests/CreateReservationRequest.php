<?php

namespace Modules\Ibooking\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateReservationRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'description' => 'required|min:2',
            'start_date' => 'required',
            'slot_id' => 'required',
            
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
            'description.required' => trans('ibooking::common.messages.description is required'),
            'description.min:2'=> trans('ibooking::common.messages.description min 2 '),
            'start_date.required' => trans('ibooking::common.messages.start_date is required'),
            'slot_id.required' => trans('ibooking::common.messages.slot_id is required'),
           
        ];
    }

    public function translationMessages()
    {
        return [
            'description.required' => trans('ibooking::common.messages.description is required'),
            'description.min:2'=> trans('ibooking::common.messages.description min 2 '),
            'start_date.required' => trans('ibooking::common.messages.start_date is required'),
            'slot_id.required' => trans('ibooking::common.messages.slot_id is required'),
            
        ];
    }
}
