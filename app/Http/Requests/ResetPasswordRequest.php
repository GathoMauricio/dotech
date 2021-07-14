<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password|min:6',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'Por favor cree una nueva contraseña',
            'password.min' => 'Su contraseña debe ser de almenos 6 dígitos alfanuméricos',
            'password_confirmation.required' => 'Por favor repita su nueva contraseña',
            'password_confirmation.same' => 'Lo sentimos su contraseña no coincide con la confirmacion, intente de nuevo.',
        ];
    }
}
