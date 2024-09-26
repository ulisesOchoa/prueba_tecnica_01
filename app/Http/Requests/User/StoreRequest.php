<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'identification' => 'required|string|max:20|unique:users,identification',
            'phone' => 'required|string|max:15',
            'city_id' => 'required|exists:cities,id',
            'department_id' => 'required|exists:departments,id',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'identification.required' => 'La identificación es obligatoria.',
            'identification.unique' => 'La identificación ya está en uso.',
            'phone.required' => 'El teléfono es obligatorio.',
            'city_id.required' => 'La ciudad es obligatoria.',
            'city_id.exists' => 'La ciudad seleccionada no es válida.',
            'department_id.required' => 'El departamento es obligatorio.',
            'department_id.exists' => 'El departamento seleccionado no es válido.',
        ];
    }
}
