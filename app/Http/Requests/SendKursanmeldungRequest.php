<?php

namespace Yours\Http\Requests;

use Yours\Http\Requests\Request;

class SendKursanmeldungRequest extends Request
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
            'spam_filter' => 'max:0',
            'courses' => 'required',
            'course_day' => 'required',
            'course_id' => 'required',
            'email' => 'required',
        ];
    }

    public function messages()
    {
        flash()->error('Nachricht konnte nicht gesendet werden');
        
        return [
            'email.required' => 'Wir benötigen Ihre E-Mailadresse.',
            'course_id' => 'Bitte eine eine Zeit aussuchen.',
            'course_day' => 'Bitte einen Tag aussuchen.',
            'courses' => 'Bitte einen Kurs aussuchen.',
        ];
    }
}
