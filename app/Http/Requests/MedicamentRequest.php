<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicamentRequest extends FormRequest
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
            "code_barre"=>"required",
            "quantite_med"=>"min: 0",
            "promo_med"=>"min: 0",
            // "photo_med" => "required|max:2048", //image
        ];
    }

    public function messages(){
        return [
            "code_barre.required"=> "* Le code barre est requis",
            "quantite_med.min"=> "* La quantité minimale est 0",
            "promo_med.min"=> "* La valeur de promotion minimale est 0",
            // "photo_med.required"=>"* La photo de medicament est requis",
            // // "photo_med.image"=>"* Le fichier doit être une image",
            // "photo_med.max"=>"* La photo ne doit pas dépasser 2 KO",
            ];
    }
}
