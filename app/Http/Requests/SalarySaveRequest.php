<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalarySaveRequest extends FormRequest
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
            //Mensaje a mostrar en caso el campo rol esté vacío
            "monto" => "required"
        ];
    }

    //Método creado para: definir mensajes personalizados para los atributos de los campos que se están validando
    public function attributes()//Este método permite personalizar los mensajes de error de validación
    {
        return [
            "monto" => "Dinero"//Cuando el campo "monto" esté vacío, indicará que el campo dinero está vacío
        ];
    }
}