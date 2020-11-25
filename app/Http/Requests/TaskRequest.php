<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'priority' => 'required',
            'context' => 'required',
            'deadline' => 'required',
            //'project_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'priority.required' => 'Seleccione una prioridad para esta tarea.',
            'context.required' => 'Seleccione el contexto para esta tarea.',
            'deadline.required' => 'Seleccione el deadline para esta tarea.',
            //'project_id' => 'Seleccione el contexto para esta tarea.',
            'user_id.required' => 'Seleccione un usuario para esta tarea.',
            'title.required' => 'Ingrese un titulo para esta taread',
            'description.required' => 'Ingrese una descripción para esta tarea.',
            'status.required' => 'Seleccione el estatus para esta tarea.',
            'visibility.required' => 'Seleccione la visibilidad para esta tarea.',
        ];
    }
}
