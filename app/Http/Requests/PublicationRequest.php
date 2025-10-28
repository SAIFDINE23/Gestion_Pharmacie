<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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
            'titre_pub' => 'required',
            'photo_pub' => 'image'
        ];
    }

    public function messages(){
        return [
            "titre_pub.required"=> "* Le titre de la publication est requis",
            "photo_mrq.image"=>"Le fichier doit être une image",
            ];
    }
}
