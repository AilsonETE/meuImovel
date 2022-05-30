<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImovelRequest extends FormRequest
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
            'titulo' => 'required',
            'descricao' => 'required' ,
            'conteudo'=> 'required',
            'price'=> 'required',
            'banheiro'=> 'required',
            'quarto'=> 'required',
            'area_propriedade'=> 'required',
            'total_area_propriedade'=> 'required',
        ];
    }
}
