<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGigRequest extends FormRequest
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
            'name' => 'nullable|string',
            'description'  => 'nullable|string',
            'timestamp_start' => 'nullable|date_format:m/d/Y h:i A',
            'timestamp_end' => 'nullable|date_format:m/d/Y h:i A',
            'number_of_positions' => 'nullable|integer',
            'pay_per_hour' => 'nullable|numeric',
            'status' => 'nullable|boolean',
        ];
    }
}
