<?php

namespace Yours\Http\Requests;

use Yours\Http\Requests\Request;

class CreatePriceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                      => 'required|unique:price',
            'amount'                    => array('required', 'regex:/^\d*(\.\d{2})?$/'),
            'duration'                  => 'required|integer',
            'duration_type'             => 'required',
            'course_count'              => 'integer',
            'status'                    => 'required',
            'first_cancel_period'       => 'required|integer',
            'further_cancel_period'     => 'required|integer',
        ];
    }
}
