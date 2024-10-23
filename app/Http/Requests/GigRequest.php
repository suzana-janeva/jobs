<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GigRequest extends FormRequest
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
            'description'  => 'required|string',
            'timestamp_start' => 'required|date_format:m/d/Y h:i A',
            'timestamp_end' => 'required|date_format:m/d/Y h:i A',
            'number_of_positions' => 'required|integer',
            'pay_per_hour' => 'required|numeric',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'status' => 'Status must be either 0 (false) or 1 (true).',
        ];
    }
}
