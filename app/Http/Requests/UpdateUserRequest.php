<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'nullable|string',
            'last_name'  => 'nullable|string',
            'email' => 'nullable|string|email|min:5|:max:155|unique:users,email,' . $this->user->id,
            'password' => [
                'string', 'min:8', 'max:100', 'regex:/^[a-zA-Z0-9]*([a-zA-Z][0-9]|[0-9][a-zA-Z])[a-zA-Z0-9]*$/',
                'confirmed'
            ],
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password must be at least 8 characters long and contain a mix of letters and numbers.',
        ];
    }
}
