<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarFacturaRequest extends FormRequest
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
          'cliente'     => 'required',
          'fecha'       => 'required',
          'comprobante' => 'required|integer'
        ];
    }

    public function messages()
    {
      return [
        'cliente.required'  => 'Debe ingresar el cliente',
        'fecha.required'    => 'Fecha invalida',
        'comprobante.required' => 'Debe ingresar el comprobante',
        'comprobante.integer' => 'Formato invalido'
      ];
    }
}
