<?php

namespace Yours\Http\Requests;

use Yours\Http\Requests\Request;

class SendKontaktRequest extends Request
{

    protected $redirect = '/#kontakt';    

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
            'email_kontakt' => 'required|email',
            'message' => 'required'
        ];
    }

    public function messages()
    {
        flash()->error('Nachricht konnte nicht gesendet werden');
        
        return [
            'email_kontakt.required' => 'Du musst eine gültige E-Mailadresse angeben.',
            'email_kontakt.email' => 'Du musst eine gültige E-Mailadresse angeben.',
            'message.required' => 'Bitte fülle das Nachrichtenfeld aus.',
        ];
    }
}
