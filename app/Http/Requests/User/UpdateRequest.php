<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'identification' => 'required|string|max:20|unique:users,identification,' . $userId,
            'phone' => 'required|string|max:15',
            'city_id' => 'required|exists:cities,id',
            'department_id' => 'required|exists:departments,id',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
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
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está en uso.',
        ];
    }
}
