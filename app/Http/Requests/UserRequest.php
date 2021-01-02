<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required',
            'middle_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Este campo es obligatorio',
            'middle_name.required' => 'Este campo es obligatorio',
            'phone.required' => 'Este campo es obligatorio',
            'email.required' => 'Este campo es obligatorio',
            'email.email' => 'Este no parece ser un email válido',
            'email.unique' => 'Este email ya se encuentra en los registros'
        ];
    }
}
