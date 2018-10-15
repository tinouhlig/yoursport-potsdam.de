<?php

namespace Yours\Http\Requests;

use Yours\Http\Requests\Request;

class UpdatePriceRequest extends Request
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
            'name'                      => 'required|unique:price,name,'.$this->price->id,
            'amount'                    => array('required', 'regex:/^\d*(\.\d{2})?$/'),
            'duration'                  => 'required|integer',
            'max_normalgroup_courses'   => 'integer',
            'max_smallgroup_courses'    => 'integer',
            'status'                    => 'required',
            'first_cancel_period'       => 'required|integer',
            'further_cancel_period'     => 'required|integer',
            'contract_extension'     => 'required|integer',
        ];
    }
}
