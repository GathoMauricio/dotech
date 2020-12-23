<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class SaleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'description' => 'required',
            'investment' => 'required',
            'estimated' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'description.required' => 'La descripción es obligatoria,',
            'investment.required' => 'El monto de inversión es obligatoria',
            'estimated.required' => 'El monto de venta es obligatorio.',
        ];
    }
}
