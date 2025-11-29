<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,'.$this->user_id,
            // 'password' => 'required|string',
            // 'user_id' => 'required|integer|exist:users,id',
            'role' => 'required|integer',
        ];
    }
    public function messages(): array
    {
        return [
            // --- Правила для 'name' ---
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.string' => 'Поле "Имя" должно быть текстовым.',

            // --- Правила для 'email' ---
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.string' => 'Поле "Email" должно быть текстовым.',
            'email.email' => 'Поле "Email" должно быть действительным адресом электронной почты.',
            'email.unique' => 'Пользователь с таким адресом электронной почты уже существует.',

            // --- Правила для 'email' ---
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.string' => 'Поле "Пароль" должно быть текстовым.',
        ];
    }
}
