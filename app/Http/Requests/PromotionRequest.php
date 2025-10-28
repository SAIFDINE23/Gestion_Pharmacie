<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
            'pourcentage' => 'required',
            'debut_promo' => 'required|date',
            'fin_promo' => 'required|date',
        ];  
    }

    public function messages(){
        return [
            "pourcentage.required"=> "Ce champs est requis",
            "debut_promo.required"=> "Ce champs est requis",
            "fin_promo.required"=> "Ce champs est requis",
            ];
    }
}
