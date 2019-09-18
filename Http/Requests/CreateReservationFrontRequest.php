<?php

namespace Modules\Ibooking\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateReservationFrontRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|min:2',
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
            'first_name.required' => trans('ibooking::reservations.messages.firstname is required'),
            'first_name.min:2'=> trans('ibooking::reservations.messages.firstname min 2 '),
            'last_name.required' => trans('ibooking::reservations.messages.lastname is required'),
            'last_name.min:2'=> trans('ibooking::reservations.messages.lastname min 2 '),
            'email.required'=> trans('ibooking::reservations.messages.email is required'),
            'email.min:2'=> trans('ibooking::reservations.messages.email min 2 '),
            'phone.required'=> trans('ibooking::reservations.messages.phone is required'),
            'phone.min:7'=> trans('ibooking::reservations.messages.phone min 7 '),
            'description.required' => trans('ibooking::common.messages.description is required'),
            'description.min:2'=> trans('ibooking::common.messages.description min 2 '),
            'start_date.required' => trans('ibooking::common.messages.start_date is required'),
            'slot_id.required' => trans('ibooking::common.messages.slot_id is required'),
           
        ];
    }

    public function translationMessages()
    {
        return [
            'first_name.required' => trans('ibooking::reservations.messages.firstname is required'),
            'first_name.min:2'=> trans('ibooking::reservations.messages.firstname min 2 '),
            'last_name.required' => trans('ibooking::reservations.messages.lastname is required'),
            'last_name.min:2'=> trans('ibooking::reservations.messages.lastname min 2 '),
            'email.required'=> trans('ibooking::reservations.messages.email is required'),
            'email.min:2'=> trans('ibooking::reservations.messages.email min 2 '),
            'phone.required'=> trans('ibooking::reservations.messages.phone is required'),
            'phone.min:7'=> trans('ibooking::reservations.messages.phone min 7 '),
            'description.required' => trans('ibooking::common.messages.description is required'),
            'description.min:2'=> trans('ibooking::common.messages.description min 2 '),
            'start_date.required' => trans('ibooking::common.messages.start_date is required'),
            'slot_id.required' => trans('ibooking::common.messages.slot_id is required'),
            
        ];
    }
}
