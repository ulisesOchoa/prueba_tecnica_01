<?php

namespace App\Http\Requests\Position;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'position_id' => 'required|exists:positions,id',
            'role' => 'required|string|max:255',
            'boss_id' => 'nullable|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'El campo de usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no es válido.',
            'position_id.required' => 'El campo de posición es obligatorio.',
            'position_id.exists' => 'La posición seleccionada no es válida.',
            'role.required' => 'El campo de rol es obligatorio.',
            'boss_id.exists' => 'El jefe seleccionado no es válido.',
        ];
    }
}
