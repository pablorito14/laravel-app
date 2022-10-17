<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarServicioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'descripcion' => 'required',
          'importe'     => 'required|numeric' //cambiar a decimal
        ];

    }

    public function messages()
    {
      return [
        'descripcion.required'  => 'Debe ingresar una descripcion',
        'importe.required'      => 'Debe ingresar el importe',
        'importe.numeric'       => 'Formato invalido'
      ];
    }
}
