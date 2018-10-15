<?php

namespace Yours\Http\Requests;

use Yours\Http\Requests\Request;

class CreateCourseRequest extends Request
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
            'time' => 'required|date_format:H:i',
            'max_participants' => 'required|integer',
            'length' => 'required|integer',
            'start' => 'date',
            'end' => 'sometimes|date|after:start',
            'status' => 'required',
            'coursetype_id' => 'required',
        ];

        //protected $fillable = ['name', 'description', 'day', 'time', 'max_participants', 'length', 'start', 'end', 'slug', 'status', 'coursetype_id'];
    }
}
