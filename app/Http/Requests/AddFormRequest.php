<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddFormRequest extends Request
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
            'mail' => ['required', 'E-Mail'],
            'image' => ['required']
        ];
    }
    
    public function messages()
    {
        return [
            'required' => 'Merci de remplir le champ :attribute',
            'E-Mail' => 'Merci de rentrer une adresse mail valide'
        ];
    }
}
