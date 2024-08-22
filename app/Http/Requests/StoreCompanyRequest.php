<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_company' => 'required|string|max:100',
            'nit' => 'required|string|min:9|max:15|unique:companies,nit',
            'email' => 'required|email|max:50|unique:companies,email',
            'address' => 'nullable|string|max:100',
            'phone' => 'nullable|numeric|digits_between:6,11',
            'bool_termino_codiciones' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name_company' => 'Organización',
            'email' => 'Correo',
            'address' => 'Dirección',
            'phone' => 'Teléfono',
            'bool_termino_codiciones' => 'Terminos y condicones',
        ];
    }
}
