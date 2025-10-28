<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdonnanceRequest extends FormRequest
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
            'nom_patient' => 'required',
            'medicaments' => 'required|array|min:1',
            'date_ord' => 'required',
            'quantite' => 'required|array'
        ];
    }

    public function messages(){
        return [
            "nom_patient.required"=> "Le nom de patient est requis",
            "medicaments.required"=>"La photo de marque est requis",
            "date_ord.required"=>"La date de l'ordonnance est requis",
            "quantite.required"=>"Les champs quantité sont requis"
            ];
    }
}
