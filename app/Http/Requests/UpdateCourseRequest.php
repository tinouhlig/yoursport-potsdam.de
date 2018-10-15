<?php

namespace Yours\Http\Requests;

use Yours\Http\Requests\Request;

class UpdateCourseRequest extends Request
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
            'day' => 'required',
            'time' => 'required|date_format:H:i:s',
            'max_participants' => 'required|integer',
            'length' => 'required|integer',
            'start' => 'date',
            'end' => 'sometimes|date|after:start',
            'status' => 'required',
            'coursetype_id' => 'required',
        ];
    }
}
