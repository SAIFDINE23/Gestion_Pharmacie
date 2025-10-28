<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarqueRequest extends FormRequest
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
            'nom_mrq'=>'required',
            'photo_mrq'=>'required|max: 2048'            
        ];
    }

    public function messages(){
        return [
            "nom_mrq.required"=> "Le nom de la marque est requis",
            "photo_mrq.required"=>"La photo de marque est requis",
            "photo_mrq.image"=>"Le fichier doit être une image",
            "photo_mrq.max"=>"La photo ne doit pas dépasser 2 KO",
            ];
    }
}
