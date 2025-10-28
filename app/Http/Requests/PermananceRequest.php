<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermananceRequest extends FormRequest
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
            'list' => 'required|mimes:pdf',
            'date_permanance' => 'required|date'
        ];
    }

    public function messages(){
        return [
            "list.required"=> "* La liste de permanance est requise",
            "list.pdf"=> "* Le fichier doit être un pdf",
            "date_permanance.required"=> "* La date est requise",
            "date_permanance.date"=> "* Le champs doit être de type date",
            ];
    }
}
